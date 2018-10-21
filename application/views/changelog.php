<div class="container">

<h3 class="p-3 text-danger">Changelog Tracker</h3>

<!-- 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->

<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" >
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-3.3.1.js"></script>
</head>


<!------ Include the above in your HEAD tag ---------->

<style>
    .tree, .tree ul {
        margin:0;
        padding:0;
        list-style:none
    }
    .tree ul {
        margin-left:1em;
        position:relative
    }
    .tree ul ul {
        margin-left:.5em
    }
    .tree ul:before {
        content:"";
        display:block;
        width:0;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        border-left:1px solid
    }
    .tree li {
        margin:0;
        padding:0 1em;
        line-height:2em;
        color:#369;
        font-weight:700;
        position:relative
    }
    .tree ul li:before {
        content:"";
        display:block;
        width:10px;
        height:0;
        border-top:1px solid;
        margin-top:-1px;
        position:absolute;
        top:1em;
        left:0
    }
    .tree ul li:last-child:before {
        background:#fff;
        height:auto;
        top:1em;
        bottom:0
    }
    .indicator {
        margin-right:5px;
    }
    .tree li a {
        text-decoration: none;
        color:#369;
    }
    .tree li button, .tree li button:active, .tree li button:focus {
        text-decoration: none;
        color:#369;
        border:none;
        background:transparent;
        margin:0px 0px 0px 0px;
        padding:0px 0px 0px 0px;
        outline: 0;
    }
    html {
        height:800px;
    }
</style>


<div class="" style="">
    <div class="">
        
        <div class="col-md-4">
            <ul id="tree3">
                <li><a href="#">PATIENT DATA </a>

                    <ul>
                        <li>Screening</li>
                        <li>Registration </li>
                                <li>Service Section
                                    <ul>
                                        <li>General</li>
                                        <li>Private</li>
                                    </ul>
                                </li>
                                <li>Biometric Logging</li>
                                <li>Patient Card Logging</li>
                        <li>Recurring Patients
                            <ul>
                                <li>Appointments Basis</li>
                            </ul>
                        </li>
                        <li>Counseling</li>
                        <li>Refraction</li>
                        <li>**Treatments**</li>
                    </ul>
                </li>
                <li >STAFF SECTION
                    <ul>
                        <li>Finance</li>
                        <li>Doctor
                            <ul>
                                <li>Service sections
                                    <ul>
                                        <li>Refraction</li>
                                        <li>Prescription</li>
                                        <li>Surgery</li>
                                    </ul>
                                </li>
                                <li>Employee Maint.</li>
                            </ul>
                        </li>
                        <li>Human Resources</li>
                    </ul>
                </li>
                <li >OPTICAL
                    <ul>
                        <li>Glasses</li>
                        <li>**</li>
                    </ul>
                </li>
                <li >PHARMACY
                    <ul>
                        <li>POS</li>
                        <li>SALES</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
        $.fn.extend({
        treed: function (o) {
        
        var openedClass = 'fa-chevron-down';
        var closedClass = 'fa-chevron-right';
        
        if (typeof o != 'undefined'){
            if (typeof o.openedClass != 'undefined'){
            openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined'){
            closedClass = o.closedClass;
            }
        };
        
            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                })
                branch.children().children().toggle();
            });
            //fire event from the dynamically added icon
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });

    //Initialization of treeviews

    $('#tree1').treed();

    $('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

    $('#tree3').treed({openedClass:'fa fa-chevron-right success', closedClass:'fa fa-chevron-down'});

</script>