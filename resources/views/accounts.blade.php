<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard For Google Accounts Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($dates as $value)
                        <p> {{ $value['month'] }} / {{ $value['day'] }} </p>
                    @endforeach
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Account Number</th>
                                <th scope="col">Account Type</th>
                                <th scope="col">Country Code</th>
                                <th scope="col">User Created ID</th>
                                <th scope="col">Account Login</th>
                                <th scope="col">Account PWD</th>
                                <th scope="col">Comment</th>
                                <!-- <th scope="col">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td> {{ $account->id }} </td>
                                    <td> {{ $account->account_number }} </td>
                                    <td> {{ $account->account_type }} </td>
                                    <td> {{ $account->country_code }} </td>
                                    <td> {{ $account->user_created_id }} </td>
                                    <td> {{ $account->account_login }} </td>
                                    <td> {{ $account->account_pwd }} </td>
                                    <td> {{ $account->comment }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
