@extends('layouts.dashbord')
@section('title', 'Agencies')
@section('content')
<style>
.ag--box {
    padding: 5px 2%;
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #E7E7E7;
    gap: 0 10px;
}

.ag--name-box {
    background: #DC3545;
    padding: 0 5px 0 8px;
    justify-content: center;
    align-items: center;
    font-size: 40px;
    font-weight: 400;
    color: #fff;
    border-radius: 6px;
}
</style>
<section class="custom--contaner">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <div class="dash--text">
        <h2>Agencies</h2>
    </div>
    <div class="view--cust--table-section">
        <div class="view--cust--table">
            <table id="tenants-table" class="table">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>URL</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>
</section>
@endsection