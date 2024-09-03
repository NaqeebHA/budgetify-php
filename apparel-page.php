<?php 
    include 'template/header.php';
?>

<div class="container-fluid">
    <h1 class="title-text">Apparels</h1>

    <!-- <table class="table table-bordered" id="category-list">
        <thead>    
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th colspan=2>Edit/Delete</th>
            </tr> 
        </thead>   
        <tbody>
        </tbody>
    </table> -->
    <div id="apparel-type-options" style="text-align:center">
        <!-- Image with an associated map -->
        <img src="/img/h.png" usemap="#bodymap" alt="Body Image" style="max-height: 450px; width: auto; outline:solid yellow 5px" class="rounded-5">

        <!-- Define the map and clickable areas -->
        <map name="bodymap">
            <!-- Head -->
            <area shape="rect" coords="100,0,170,80" alt="Head" href="head.html">

            <!-- Right Arm -->
            <area shape="rect" coords="30,80,100,260" alt="Right Arm" href="right-arm.html">

            <!-- Left Arm -->
            <area shape="rect" coords="170,80,240,260" alt="Left Arm" href="left-arm.html">

            <!-- Top -->
            <area shape="rect" coords="100,80,170,195" alt="Top" href="top.html">

            <!-- Bottom -->
            <area shape="rect" coords="70,195,170,600" alt="Bottom" href="bottom.html">

            <!-- Right Leg
            <area shape="rect" coords="250,450,300,600" alt="Right Leg" href="right-leg.html"> -->
        </map>
    </div>
</div>
<div id="response"></div>

<?php
    include 'template/footer.php';
?>