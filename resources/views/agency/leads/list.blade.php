@extends('layouts.agency')
@section('title', 'Leads List')
@section('content')
<section class="custom--contaner">
    <div class="dash--text-leads">
        <h2>View Leads</h2>
        <div class="table-buttons">
        <form id="exportForm" action="/leads-export" method="post">
            @csrf 
            <input type="hidden" name="selectedLeadIds" id="selectedLeadIds" value="">
        </form>
            <a id="exportCCA" href="#" class="btn btn-success btn-sm mr-2">Export</a>
            <a id="importCCA" href="#" onclick="openleadsModal()" class="btn btn-success btn-sm mr-2">Import</a>
        </div>
    </div>
    <div class="view--cust--table-section">
        <div class="view--cust--table" style="overflow-x:auto;">
            <table id="leads-table" class="display">
                <thead>
                    <tr>
                        <th>Select All <input type="checkbox" name=""></th>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>Visited</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>State</th>
                        <th>Site</th>
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div id="leadsModal" class="overlay popup-modal">
            <div class="modal">
                <span class="close-btn" onclick="closeleadsModal()">&times;</span>
                <div class="modal-inner-btns">
                    <form action="/leads-import" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-dropdown">
                            <label for="choose_usr_email">Import Leads :</label>
                            <input type="file" name="file" required>
                        </div>
                        <div class="popup-btns-inner">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection