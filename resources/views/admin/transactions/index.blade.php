@extends('layouts.template')

@section('x-content')
    <x-layouts.user-table title="Transactions" description="All transactions in the system."
    >

        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div
                        class="overflow-hidden @if(!$transactions->isEmpty()) shadow ring-1 ring-black ring-opacity-5 @endif md:rounded-lg">
                        @if($transactions->isEmpty())
                            <div class="flex justify-center flex-col space-y-10 items-center mt-28">
                                <x-undraw.file/>
                                <p class="text-sm text-gray-600">
                                    There is no transaction has been made.
                                </p>
                            </div>
                        @else
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 text-left text-sm font-semibold text-gray-900 pl-4 pr-3">
                                        No.
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 text-left text-sm font-semibold text-gray-900 px-3">
                                        Patient
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 text-left text-sm font-semibold text-gray-900 px-3">
                                        Case
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 text-left text-sm font-semibold text-gray-900 px-3">
                                        Payment ID
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 text-left text-sm font-semibold text-gray-900 px-3">
                                        Reference
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 text-left text-sm font-semibold text-gray-900 px-3">
                                        Status
                                    </th>

                                </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 bg-white">

                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="text-gray-500">
                                                {{ $loop->iteration}}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-500">
                                                {{ $transaction->appointment->patient->user->name }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-500">
                                                {{ $transaction->appointment->case }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-500">
                                                {{ $transaction->payment_id }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-500">
                                                {{ $transaction->toyyibpay_id ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-gray-500">
                                         <span
                                             class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 @if($transaction->status == 'pending') bg-blue-100 text-blue-800 @elseif($transaction->status == 'completed') bg-green-100 text-green-800 @elseif($transaction->status == 'failed') bg-red-100 text-red-800 @else bg-yellow-100 text-yello-800 @endif">
                                                {{ str($transaction->status)->title() }}
                                         </span>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @endif
                    </div>

                    <div class="mt-5">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>

    </x-layouts.user-table>
@endsection
