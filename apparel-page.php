<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Apparels</h1>
    <div class="title-text"><a id="addApparelBtn" class="btn rounded" href="addApparel.php">Add Apparel</a></div>

    <div class="row">
    <div id="apparel-type-options" class="col-3">
            <!-- Image with an associated map -->
            <img src="/img/h.png" usemap="#bodymap" alt="Body Image" style="max-height: 450px; width: auto; outline:solid yellow 5px" class="rounded-5">

            <!-- Define the map and clickable areas -->
            <map name="bodymap">
                <!-- Head -->
                <area id="head" shape="rect" coords="100,0,170,80" alt="Head" href="head">

                <!-- Top -->
                <area id="top" shape="rect" coords="100,80,170,195" alt="Top" href="top">

                <!-- Bottom -->
                <area id="bottom" shape="rect" coords="70,195,170,600" alt="Bottom" href="bottom">

                <!-- Right Arm -->
                <area id="arm-r" class="arm" shape="rect" coords="30,80,100,260" alt="Arm" href="arm">

                <!-- Left Arm -->
                <area id="arm-l" class="arm" shape="rect" coords="170,80,240,260" alt="Arm" href="arm">
            </map>
        </div>
        <div id="apparel-type-table" class="col">
            <div id="apparel-type" class="text-center"></div>
            <table id="apparel-table" class="table table-bordered table-dark my-auto text-center">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    
</div>
<div id="response"></div>

<?php
    include 'template/footer.php';
?>

<script type="text/javascript">
    $(function() {
        $('#head').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'requestHandler.php?action=getByType&id=1',
                method: 'GET',
                success: function(response) {

                    var $apparelTableHead = $('#apparel-table thead');
                    var $apparelTableBody = $('#apparel-table tbody');

                    if (response.error) {
                        $apparelTableHead.empty(); 
                        $apparelTableBody.empty(); 
                        $('#apparel-type').empty();
                        alert(response.error);
                    } else {
                        $apparelTableHead.empty(); 
                        $apparelTableHead.append('<tr><th>Date</th><th>Note</th><th>Color</th><th>Action</th></tr>');
                        $apparelTableBody.empty(); 
                        $('#apparel-type').html('HEAD');
                        $.each(response, function(index, apparel) {
                            var row = '<tr>' +
                                '<td>' + apparel.purchased_date + '</td>' +
                                '<td>' + apparel.note + '</td>' +
                                '<td>' + apparel.color + '</td>' +
                                '<td>' +
                                    "<a href=\'apparel-details.php?id="+ apparel.id +"\'><i class=\"bi bi-eye\"></i></a>" +
                                '</td>' +
                                '</tr>';
                            $apparelTableBody.append(row);;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            })
        });

        $('#top').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'requestHandler.php?action=getByType&id=2',
                method: 'GET',
                success: function(response) {

                    var $apparelTableHead = $('#apparel-table thead');
                    var $apparelTableBody = $('#apparel-table tbody');

                    if (response.error) {
                        $apparelTableHead.empty(); 
                        $apparelTableBody.empty(); 
                        $('#apparel-type').empty();
                        alert(response.error);
                    } else {
                        $apparelTableHead.empty(); 
                        $apparelTableHead.append('<tr><th>Date</th><th>Note</th><th>Color</th><th>Action</th></tr>');
                        $apparelTableBody.empty(); 
                        $('#apparel-type').html('TOP');
                        $.each(response, function(index, apparel) {
                            var row = '<tr>' +
                                '<td>' + apparel.purchased_date + '</td>' +
                                '<td>' + apparel.note + '</td>' +
                                '<td>' + apparel.color + '</td>' +
                                '<td>' +
                                    "<a href=\'apparel-details.php?id="+ apparel.id +"\'><i class=\"bi bi-eye\"></i></a>" +
                                '</td>' +
                                '</tr>';
                            $apparelTableBody.append(row);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            })           
        });

        $('#bottom').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'requestHandler.php?action=getByType&id=3',
                method: 'GET',
                success: function(response) {

                    var $apparelTableHead = $('#apparel-table thead');
                    var $apparelTableBody = $('#apparel-table tbody');

                    if (response.error) {
                        $apparelTableHead.empty(); 
                        $apparelTableBody.empty(); 
                        $('#apparel-type').empty();
                        alert(response.error);
                    } else {
                        $apparelTableHead.empty(); 
                        $apparelTableHead.append('<tr><th>Date</th><th>Note</th><th>Color</th><th>Action</th></tr>');
                        $apparelTableBody.empty(); 
                        $('#apparel-type').html('BOTTOM');
                        $.each(response, function(index, apparel) {
                            var row = '<tr>' +
                                '<td>' + apparel.purchased_date + '</td>' +
                                '<td>' + apparel.note + '</td>' +
                                '<td>' + apparel.color + '</td>' +
                                '<td>' +
                                    "<a href=\'apparel-details.php?id="+ apparel.id +"\'><i class=\"bi bi-eye\"></i></a>" +
                                '</td>' +
                                '</tr>';
                            $apparelTableBody.append(row);;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            })           
        });

        $('.arm').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'requestHandler.php?action=getByType&id=4',
                method: 'GET',
                success: function(response) {

                    var $apparelTableHead = $('#apparel-table thead');
                    var $apparelTableBody = $('#apparel-table tbody');

                    if (response.error) {
                        $apparelTableHead.empty(); 
                        $apparelTableBody.empty(); 
                        $('#apparel-type').empty();
                        alert(response.error);
                    } else {
                        $apparelTableHead.empty(); 
                        $apparelTableHead.append('<tr><th>Date</th><th>Note</th><th>Color</th><th>Action</th></tr>');
                        $apparelTableBody.empty(); 
                        $('#apparel-type').html('ARM');
                        $.each(response, function(index, apparel) {
                            var row = '<tr>' +
                                '<td>' + apparel.purchased_date + '</td>' +
                                '<td>' + apparel.note + '</td>' +
                                '<td>' + apparel.color + '</td>' +
                                '<td>' +
                                    "<a href=\'apparel-details.php?id="+ apparel.id +"\'><i class=\"bi bi-eye\"></i></a>" +
                                '</td>' +
                                '</tr>';
                            $apparelTableBody.append(row);;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            })           
        });
    })
</script>