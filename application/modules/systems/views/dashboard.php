<h5 class="m-3 pull-left">Dashboard</h5>
<a href="<?=base_url('systems/audit_trail')?>" class="btn btn-sm btn-sap pull-right m-3">AUDIT TRAIL</a>
<hr>
<div class="col-lg-3 col-md-4 pull-left">
    
    <div class="panel">
        <span class="pt-2 pl-2 pb-0 text-success h5 mb-0"> Sections</span>
        <hr>
        <div class="ml-2">
            <a href="<?=base_url('users')?>" class="btn alert-primary btn-primary btn-sm m-1">UAC</a>
            <a href="<?=base_url('screening/dashboard')?>" class="btn alert-primary btn-primary btn-sm m-1">Registration & Screening</a>
            <a href="<?=base_url('doctor')?>" class="btn alert-danger btn-primary btn-sm m-1">Doctors Panel</a>
            <a href="<?=base_url('pharmacy')?>" class="btn alert-dark btn-primary btn-sm m-1">Pharmacy Dashboard</a>
            <a href="<?=base_url('finance/transactions')?>" class="btn alert-dark btn-primary btn-sm m-1">Cashier & POS</a>
            <a href="<?=base_url('patient/clinics')?>" class="btn alert-dark btn-primary btn-sm m-1">Clinics</a>
            <a href="<?=base_url('patient/mwork')?>" class="btn alert-success btn-primary btn-sm m-1">Mobile Workspace</a>
            <a href="<?=base_url('patient/svc/refraction')?>" class="btn alert-success btn-primary btn-sm m-1">Refraction</a>
            <a href="<?=base_url('doctor/diary')?>" class="btn alert-success btn-primary btn-sm m-1">Appointments</a>
            <a href="<?=base_url('billing/activecharge')?>" class="btn alert-success btn-primary btn-sm m-1">Active Charges</a>
        </div>
        
    </div>
</div>

<div class="col-lg-6 col-md-8 pull-left" style="border-left:1px solid #ddd">    
<span class="pt-2 pl-2 pb-0 text-danger h5 mb-0"> Questate</span>
        <hr>    
        <span class="badge btn-danger badge-pill">20</span>
        <span class="text-secondary ml-2">Chaplain 
            <a href='<?=base_url('patient/svc/chaplain')?>' class="badge badge-danger pull-right">View All</a>
        </span>
        <span class="card p-2 m-1">
            <span class="rowd text-dark">
                <strong>Next :</strong>
                Nancy Akello
                (51 yrs)
                <br>
                <strong class="text-danger">Cc.</strong>
                <small>Injured while splitting wood</small>

            </span> 
        </span>
        <hr>
        <span class="badge btn-warning badge-pill">5</span>
        <span class="text-secondary ml-2">Refraction 
            <a href='<?=base_url('patient/svc/refraction')?>' class="badge badge-warning pull-right">View All</a>
            
        </span>
        <span class="card p-2 m-1">
            <span class="rowd text-dark">
                <strong>Next :</strong>
                Anthony Joshua
                (21 yrs)
                <br>
                <strong class="text-info">Religious Status.</strong>
                <small>Muslim</small>

            </span> 
        </span>
        <hr>
        <span class="badge btn-success badge-pill">5</span>
        <span class="text-secondary ml-2">Lab & Surgery 
            <a href='<?=base_url('doctor/svc/theatrelist')?>' class="badge badge-success pull-right">Access Theatre List</a>
            
        </span>
        <span class="card p-2 m-1">
            <span class="rowd text-dark">
                <strong>Today</strong><br>
                <ol>
                    <li>Felix Maranga (28 yrs)</li>
                    <li>Faith Moturi (28 yrs)</li>
                </ol>
                <strong class="text-secondary">Procedures.</strong>
                <small>FB Irrigation</small>

            </span> 
        </span>
        <hr>
        <span class="badge btn-primary badge-pill">0</span>
        <span class="text-secondary ml-2">Paediatric 
            <a href='<?=base_url('patient/svc/paed')?>' class="badge badge-primary pull-right">NA</a>
        </span>
        <span class="card p-2 m-1">
            <span class="rowd text-dark">
                <strong>Next :</strong>
                No Queue
                <br>
                <strong class="text-info">Patients Today.</strong>
                <small>3</small><br>
                <strong class="text-secondary">Last patient.</strong><br>
                    James Mwangombe
            </span> 
        </span>
        <hr>
</div>
<div class="col-lg-3 col-md-12 pull-right" style="border-left:1px solid #fff">    
<span class="pt-2 pl-2 pb-0 text-primary h5 mb-0"> Billing</span>
        <hr>        
        <div class="text-secondary ml-3">
            <div class="text-dark h6">Payments</div>
            <div class="rowd">Today: <span class="pull-right">220,000.00</span></div>
            <div class="rowd">Past Week : <span class="pull-right">220,000.00</span></div>
            <hr>
            
            <div class="text-dark h6">Invoices</div>
            <div class="rowd">Paid : <span class="pull-right">30.000.00</span></div>
            <div class="rowd">Due : <span class="pull-right">300.000.00</span></div>
<hr>
<div class="pull-right">
    <a href="" class="btn alert-primary btn-sm m-1 pull-right badge-pill">Data Reports</a><br>
    <a href="<?=base_url('billing/activecharge')?>" class="btn badge-info badge-pill btn-sm m-1 pull-right">Active Charges</a>
</div>


        </div>
<?php 

