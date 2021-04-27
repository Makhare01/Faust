<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Faust') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="/img/f.png" type="image/x-icon">

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->

        <style>
            ::-webkit-scrollbar {
                width: 10px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .addModel {
                /* width: 1000px !important; */
            }
            table {
                border: solid 1px black !important;
            }
            th, td {
                border-right: solid 1px black !important;
            }
            .account-table thead tr th, .account-table tbody tr td {
                font-size: 10px !important;
            }
            .edit-label {
                font-size: 18px;
            }
            /* The Modal (background) */
            .modalnew {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 2%; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-contentnew {
                background-color: #fefefe;
                margin: auto;
                border: 1px solid #888;
                width: 100% !important;
                max-width: 520px !important;
                border-radius: 7px !important;
            }

            .Comment {
                width:100% !important; 
                max-width:100px !important; 
                overflow:auto !important;
            }
            .Comment::-webkit-scrollbar {
                height: 5px;
            }

            @media only screen and (max-width: 1000px) {
                .rollerModalTables {
                    display: block !important;
                }
                .rollerModalTablesDiv {
                    width: 100% !important;
                }
                .rollerModalTablesDiv1 {
                    width: 100% !important;
                    margin-top: 20px !important;
                }
            }

        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            function myTrim(x) {
                return x.replace(/^\s+|\s+$/gm, '');
            }

            function Clear() {
                document.getElementById('choosenAccount').value = '';
                document.getElementById('account_id').value = null;
                document.getElementById('choosenOffer').value = '';
                document.getElementById('offer_id').value = null;
            }

            function addAccount(id) {
                var account = document.getElementById('account' + id).textContent;
                document.getElementById('choosenAccount').value = myTrim(account);
                var accountId = document.getElementById('accountId' + id).textContent;
                document.getElementById('account_id').value = parseInt(accountId);
            }

            function addOffer(id) {
                var offer = document.getElementById('offer' + id).textContent;
                document.getElementById('choosenOffer').value = offer;
                var offerId = document.getElementById('offerId' + id).textContent;
                document.getElementById('offer_id').value = parseInt(offerId);
            } 

            // Account modal

            function modalAccount(id) {
                var modal = document.getElementById("myModalAc" + id);
                modal.style.display = "block";
            }

            function closeAccountModal(id) {
                var modal = document.getElementById("myModalAc" + id);
                modal.style.display = "none";
            }

            function closeModal(id) {
                var modal = document.getElementById("myModalAc" + id);
                modal.style.display = "none";
            }

            function enableStateEdit(id) {
                var disable = document.getElementById("state"+id);
                disable.style.pointerEvents = "all";
                disable.style.background = "#FFFFFF";
            }

            function enableState() {
                var disable = document.getElementById("state");
                disable.style.pointerEvents = "all";
                disable.style.background = "#FFFFFF";
            }
            // Delete modal
            function modalDelete(id) {
                var modal = document.getElementById("myModalDelete" + id);
                modal.style.display = "block";
            }

            function closeDeleteModalX(id) {
                var modal = document.getElementById("myModalDelete" + id);
                modal.style.display = "none";
            }

            function closeDeleteModal(id) {
                var modal = document.getElementById("myModalDelete" + id);
                modal.style.display = "none";
            }

            // Ready modal
            function modalReady(id) {
                var modal = document.getElementById("myModalReady" + id);
                modal.style.display = "block";
            }

            function closeReadyModalX(id) {
                var modal = document.getElementById("myModalReady" + id);
                modal.style.display = "none";
            }

            function closeReadyModal(id) {
                var modal = document.getElementById("myModalReady" + id);
                modal.style.display = "none";
            }

            // Offer modal

            function modal(id) {
                var modal = document.getElementById("myModal" + id);
                modal.style.display = "block";
            }

            function closeModalO(id) {
                var modal = document.getElementById("myModal" + id);
                modal.style.display = "none";
            }

            function closeM(id) {
                var modal = document.getElementById("myModal" + id);
                modal.style.display = "none";
            }

            // Roller work modal
            function modalCaseWork(id) {
                var modal = document.getElementById("myModalCaseWork" + id);
                modal.style.display = "block";
            }

            function closeCaseWorkModalX(id) {
                var modal = document.getElementById("myModalCaseWork" + id);
                modal.style.display = "none";
            }

            function closeCaseWorkModal(id) {
                var modal = document.getElementById("myModalCaseWork" + id);
                modal.style.display = "none";
            }

            // Roller review modal
            function modalReview(id) {
                var modal = document.getElementById("myModalReview" + id);
                modal.style.display = "block";
            }

            function closeReviewModalX(id) {
                var modal = document.getElementById("myModalReview" + id);
                modal.style.display = "none";
            }

            function closeReviewModal(id) {
                var modal = document.getElementById("myModalReview" + id);
                modal.style.display = "none";
            }

            // Roller billing modal
            function modalBilling(id) {
                var modal = document.getElementById("myModalBilling" + id);
                modal.style.display = "block";
            }

            function closeBillingModalX(id) {
                var modal = document.getElementById("myModalBilling" + id);
                modal.style.display = "none";
            }

            function closeBillingModal(id) {
                var modal = document.getElementById("myModalBilling" + id);
                modal.style.display = "none";
            }

            // Suspend modal
            function modalSuspend(id) {
                var modal = document.getElementById("myModalSuspend" + id);
                modal.style.display = "block";
            }

            function closeSuspendModalX(id) {
                var modal = document.getElementById("myModalSuspend" + id);
                modal.style.display = "none";
            }

            function closeSuspendModal(id) {
                var modal = document.getElementById("myModalSuspend" + id);
                modal.style.display = "none";
            }

            // Superadmin Delete modal
            function modalSupDelete(id) {
                var modal = document.getElementById("myModalSupDelete" + id);
                modal.style.display = "block";
            }

            function closeSupDeleteModalX(id) {
                var modal = document.getElementById("myModalSupDelete" + id);
                modal.style.display = "none";
            }

            function closeSupDeleteModal(id) {
                var modal = document.getElementById("myModalSupDelete" + id);
                modal.style.display = "none";
            }

            // Superadmin Work modal
            function modalSupWork(id) {
                var modal = document.getElementById("myModalSupWork" + id);
                modal.style.display = "block";
            }

            function closeSupWorkModalX(id) {
                var modal = document.getElementById("myModalSupWork" + id);
                modal.style.display = "none";
            }

            function closeSupWorkModal(id) {
                var modal = document.getElementById("myModalSupWork" + id);
                modal.style.display = "none";
            }

            // Superadmin Valid modal
            function modalSupValid(id) {
                var modal = document.getElementById("myModalSupValid" + id);
                modal.style.display = "block";
            }

            function closeSupValidModalX(id) {
                var modal = document.getElementById("myModalSupValid" + id);
                modal.style.display = "none";
            }

            function closeSupValidModal(id) {
                var modal = document.getElementById("myModalSupValid" + id);
                modal.style.display = "none";
            }

            // User Delete modal
            function modalUserDelete(id) {
                var modal = document.getElementById("myModalUserDelete" + id);
                modal.style.display = "block";
            }

            function closeUserDeleteModalX(id) {
                var modal = document.getElementById("myModalUserDelete" + id);
                modal.style.display = "none";
            }

            function closeUserDeleteModal(id) {
                var modal = document.getElementById("myModalUserDelete" + id);
                modal.style.display = "none";
            }

            // Checkbox
            function checkBox() {
                var checkBox = document.getElementById("account_numbercheck");
                var text = document.getElementById("account_number");
                if (checkBox.checked == true){
                    text.style.pointerEvents  = "All";
                    text.style.background = "#FFFFFF";
                } else {
                    text.style.pointerEvents  = "none";
                    text.style.background = "#EFF1F3";
                }
            }

            // Edit Checkbox
            function checkBoxEdit(id) {
                var checkBox = document.getElementById(id);
                var text = document.getElementById("account_"+id);
                if (checkBox.checked == true){
                    text.style.pointerEvents  = "All";
                    text.style.background = "#FFFFFF";
                    // text.style.border = "solid 1px red";
                } else {
                    text.style.pointerEvents  = "none";
                    text.style.background = "#EFF1F3";
                }
            }
        </script>
    </body>
</html>
