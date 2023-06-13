<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public string $url = 'https://dev.toyyibpay.com/';
    public string $paymentId = '';
    public ?Model $patient = null;

    public function __construct(
        public string $patientId = '',
        public string $appointmentId = ''
    )
    {
        $this->middleware('auth');
        $this->paymentId = uniqid();
    }

    public function create(): Transaction
    {
        $this->patient = Patient::query()->findOrFail($this->patientId);

        return Transaction::query()->create([
            'payment_id' => $this->paymentId,
            'patient_id' => $this->patient->id,
            'appointment_id' => $this->appointmentId,
            'status' => 'pending'
        ]);
    }

    public function createPayment(): string|bool
    {
        $requiredData = array(
            'userSecretKey' => config('services.toyyibpay.secret_key'),
            'categoryCode' => config('services.toyyibpay.category_code'),
            'billName' => config('services.toyyibpay.bill_name'),
            'billDescription' => config('services.toyyibpay.bill_description'),
            'billPriceSetting' => config('services.toyyibpay.bill_price_setting'),
            'billPayorInfo' => config('services.toyyibpay.bill_payor_info'),
            'billAmount' => config('services.toyyibpay.bill_amount'),
            'billReturnUrl' => route('transactions.callback'),
            'billCallbackUrl' => route('transactions.callback'),
            'billPaymentChannel' => config('services.toyyibpay.bill_payment_channel'),
            'billContentEmail' => config('services.toyyibpay.bill_content_email'),
            'billExternalReferenceNo' => $this->paymentId,
            'billTo' => $this->patient->user->name,
            'billEmail' => $this->patient->user->email,
            'billPhone' => $this->patient->user->phone_number,
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $this->url . 'index.php/api/createBill');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requiredData);

        $result = curl_exec($curl);
        curl_close($curl);

        try {
            if (str($result)->contains('error')) return false;
            $result = json_decode($result)[0]->BillCode;
        } catch (\Exception $e) {
            return false;
        }

        return $this->getUrl($result);
    }

    /**
     * The callback function for the payment gateway
     *
     * @param Request $request
     */
    public function callback(Request $request)
    {
        if (!Auth::user()->isPatient() || !$request->all() || !Arr::has($request->all(), ['status_id', 'billcode', 'order_id', 'msg', 'transaction_id'])) {
            abort('404', 'Page Not Found');
        }

        $transaction = Transaction::query()->where('payment_id', $request->order_id)->first();

        if (!$transaction || $transaction->patient->id != Auth::user()->patient->id) {
            abort('401', 'Unauthorized Request');
        }

        $paymentStatus = $this->getPaymentStatus($request->get('billcode'));

        $transaction->update([
            'toyyibpay_id' => $request->get('transaction_id'),
            'status' => ($paymentStatus == '1' ? 'completed' : 'failed')
        ]);

        $result = null;

        if ($paymentStatus == '1') {
            $result = $transaction->appointment()->update([
                'status' => 'pending'
            ]);

        } else {
            $result = $transaction->appointment()->update([
                'status' => 'failed'
            ]);
        }

        if (!$result) {
            abort('500', 'Internal Server Error');
        }

        if ($paymentStatus != '1') return redirect()->route('appointments.index')->with([
            'status' => 'error',
            'message' => 'Payment has been failed! Please try again later.'
        ]);

        return redirect()->route('appointments.index')->with([
            'status' => 'success',
            'message' => 'Appointment has been booked successfully!'
        ]);
    }

    /**
     * @param $billCode
     * @return string
     */
    public function getUrl($billCode): string
    {
        return $this->url . $billCode;
    }

    public function getPaymentStatus(string $billCode)
    {
        $data = array(
            'billCode' => $billCode,
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $this->url . 'index.php/api/getBillTransactions');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($curl);
        curl_close($curl);

        if (str($result)->contains('No data found!')) return false;

        try {
            $result = json_decode($result)[0]->billpaymentStatus;
        } catch (\Exception $e) {
            return false;
        }

        return $result;
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->isDoctor()) {
            return redirect()->route('dashboard')->with([
                'status' => 'error',
                'message' => 'You are not allowed to access this page.'
            ]);
        }

        if (!$user->hasRequiredData()) {
            return redirect()->route('profile.index')->with([
                'status' => 'error',
                'message' => 'Your account is being limited. Please complete your profile to continue.'
            ]);
        }

        if ($user->isAdmin()) {

            if ($request->get('search')) {
                $transactions = Transaction::query()
                    ->where('payment_id', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('toyyibpay_id', 'like', '%' . $request->get('search') . '%')
                    ->latest()
                    ->simplePaginate(10)
                    ->withQueryString();

                return view('admin.transactions.index', ['transactions' => $transactions]);
            }

            $transactions = Transaction::query()->latest()->simplePaginate(10);
            return view('admin.transactions.index', compact('transactions'));
        }

        if ($request->get('search')) {
            $transactions = Transaction::query()
                ->where('patient_id', $user->patient->id)
                ->where(fn(Builder $query) => $query
                    ->where('payment_id', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('toyyibpay_id', 'like', '%' . $request->get('search') . '%'))
                ->latest()
                ->simplePaginate(10)
                ->withQueryString();

            return view('patient.transactions.index', ['transactions' => $transactions]);
        }

        $transactions = Transaction::query()->where('patient_id', $user->patient->id)->simplePaginate(10);
        return view('patient.transactions.index', compact('transactions'));
    }
}
