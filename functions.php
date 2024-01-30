<?php
   $conn = mysqli_connect("localhost","root","","easyparkir");

   function query( $query ){
      $result = mysqli_query( $conn, $query );
      $rows = [];
      while ($row = mysqli_fetch_array($result)) {
      $rows[] = $row;
      }
   return $rows;
   }
?>