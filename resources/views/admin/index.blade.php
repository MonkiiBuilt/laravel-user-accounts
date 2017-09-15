<?php
/**
 * @author Jonathon Wallen
 * @date 24/4/17
 * @time 11:45 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor.laravel-administrator.layout')

@section('title', 'User Accounts')

@section('content')
    <h1>User Accounts</h1>

    <h3 class="dash-title">Add accounts</h3>
    <div class="panel  panel__half">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full  create  solo-button">

                    <a href="{{ route('laravel-administrator-user-accounts-create') }}" class="btn  btn--primary">
                        <span class="plus-span">
                            <svg class="icon icon-plus-circle"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus-circle"></use></svg>
                        </span>
                        Add new account
                    </a>

                </div>
            </div>

        </div>
    </div>

    <h3 class="dash-title">Existing accounts</h3>
    <div class="panel">

        <table id="accounts" class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width:20%">Name</th>
                <th style="width:20%">Email</th>
                <th style="width:20%">Updated At</th>
                <th style="width:20%">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->email }}</td>
                    <td>{{ $account->updated_at }}</td>
                    <td></td>
                </tr>
            @endforeach()
            </tbody>
        </table>

    </div>

    <!-- This contains the content for Colorbox modal inline calls -->
    <div class='colorbox-inline'>
        <div id='confirm_content'>
            <h3>Are you sure you want to remove this account?</h3>
            <a class="btn  btn--primary  confirm_link">Yes</a>
            <a class="btn  btn--tertiary  confirm_link">No</a>
        </div>
    </div>
@endsection

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
            oTable = $('#accounts').dataTable({
                "ajaxSource": "{{ route('laravel-administrator-user-accounts-data') }}",
                "autoWidth": false,
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [3] }
                ],
                "aaSorting": [[ 3, "desc" ]],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search..."
                },
                "fnDrawCallback": function (oSettings) {
                    onTableSetup();
                }
            });
        });
    </script>
@endsection

