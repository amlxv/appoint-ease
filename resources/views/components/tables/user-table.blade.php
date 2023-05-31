<div class="flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">

                    <thead class="bg-gray-50">
                    <tr>
                        @foreach($tableData['columns'] as $key => $data)
                            <th scope="col"
                                class="py-3.5 text-left text-sm font-semibold text-gray-900 @if($loop->first) pl-4 pr-3 @else px-3 @endif">
                                {{ $key }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($tableData['users'] as $user)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full">
                                        @if($user->profile_photo_path)
                                            <img class="h-10 w-10 rounded-full"
                                                 src="{{ asset('storage/'.$user->profile_photo_path) }}"
                                                 alt="{{ $user->name }}">
                                        @else
                                            <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path
                                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            @foreach($tableData['columns'] as $key => $column)

                                @if($loop->first || $loop->last)
                                    @continue
                                @endif

                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="text-gray-500">
                                        @if($key == 'Status')
                                            <span
                                                class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ data_get($user, $column) == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}}">{{ data_get($user, $column) == 'active' ? 'Available' : 'Not Available' }}</span>
                                        @else
                                            {{ data_get($user, $column) }} @if ($key == 'Experience')
                                                years
                                            @endif
                                        @endif
                                    </div>
                                </td>

                            @endforeach

                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                <a href="{{ route($tableData['route'].'.edit', data_get($user, $tableData['id'])) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

            <div class="mt-5">
                {{ $tableData['users']->links() }}
            </div>
        </div>
    </div>
</div>
