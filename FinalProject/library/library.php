<!DOCTYPE html>
<html lang="en">
<head>
  <title>Knowledge Hub</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" ></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="main.css">
  <link rel="stylesheet" type="text/css" href="library.css">
 
  <style type="text/css">

    th, td { 
      white-space: nowrap; 
    }

    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
 
    th input {
        width: 90%;
    }
  </style>


  </head>

  
  <body>

  
<div class="container">
 
 <h1> Knowledge Hub | Library Catalog </h1>



  <div class="row">
    <div class="col-md-12">
      
         <form class="form-horizontal searchForm" role="form" action="library.php" method="post">
              <div class="input-group" id="adv-search">
                <input type="text" name="searchTxt" class="form-control lrgsrch fontmore" placeholder="What can we help you find?"/>
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle lrgsrch" data-toggle="dropdown" aria-expanded="false">More Options<span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                               <h4 class="text-muted"> Refine your search </h4>
                                  <div class="form-group">
                                  <label class="radio-inline">
                                    <input type="radio" name="optradio" value="title">Title
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="optradio" value="author">Author
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="optradio" value="isbn">ISBN
                                  </label>
                              
                                  </div>
                                  <h4 class="text-muted"> Search by </h4>
                                  <div class="form-group">
                                  
                                    <label for="contain">Keyword</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Contains the words</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary lrgsrch"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                     </div>
                </div>
            </div>
            </form>      

      </div>
    </div>

</div>
    

 <div class='container text-center'>
     <h2> Displaying results : </h2>
  
  </div>       

 <div class="container">
 <div class="row">

<div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">  

                     Showing results for search : <? echo $_POST['searchTxt'] ?> 
                  </h3>
               
                </div>
              </div>
              <div class="panel-body">     

               <div class="row">
               <div class="col col-sm-6">
               <div class="dataTables_length" id="example_length">
               <label>Show 
               <select name="example_length" aria-controls="searchData" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> 

               entries</label>

               </div>
               </div>
               <div class="col-sm-6">
               <div id="global_filter" class="dataTables_filter">
               <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="searchData"></label>
               </div>
               </div>
               </div> 

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Knowledge_hub";

/*
// Insert into db

try {
 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `mydb`.`users`(`user_id`,`firstName`,`lastName`,`userName`,`password`) VALUES ('','test1','test1','test1','test1');";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
*/

// retrieve from db

    // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$srchText = '';
$bookFilter = '';

if(preg_match("^/[A-Za-z]+/", $_POST['searchTxt']))
{
if (!empty($_REQUEST['bookFilter']) && !empty($_REQUEST['searchTxt'])) {

     $bookFilter = stripslashes($_REQUEST['bookFilter']);
     $srchText = stripslashes($_REQUEST['searchTxt']);
     }

}

$sql = "SELECT * FROM books WHERE 1";
$result = $conn->query($sql); ?>

<?php  if ($result->num_rows > 0) { ?>
    

   
    
 
    <?php echo $srchText ?> </strong></p>
    <?php 
    if(empty($_REQUEST['searchTxt']))
    {
     ?>
    <p> No Records exist for the the search query </p> 
    <?php }
    ?>

    <table id="searchData" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    <thead><tr></tr> </thead>
    <tbody>
<?php    
    while($row = $result->fetch_assoc()) { ?>

        <tr>
        <td><p> <?php echo $row["isbn"] ?> </p></td>
        <td>
        <p><?php echo $row["bookTitle"] ?></p>
        <p><?php echo $row["bookName"] ?> </p>
        <p> by <?php echo $row["authorName"] ?> </p>
        
        </td>
        <td> <p> <strong> No of Books available: </strong>
        <?php echo $row["booksQnty"] ?> </p> </td>
           <td>

        <a href="borrowBook.html">
         <?php if($row["booksQnty"] > 0){ ?>
        <button type="button" name="borrowBook" value="$row['isbn']" class="btn btn-success btn-md active">Borrow Book</button>
        <?php } else { ?>
        <button type="button" name="borrowBook" value="$row['isbn']" class="btn btn-success btn-md disabled">Borrow Book</button>
        <?php } ?>
        </a></td>

      </tr>
   <?php } ?>
</tbody> </table>

</div>
  
<div class="panel-footer">
                    <div class="row">
                        <div class="col col-xs-offset-3 col-xs-6">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                      
                    </div>
                </div>


  </div>

</div>
</div>
</div>
<?php

 } else {
    echo "0 results";
}

?>

<script>

function filterGlobal () {
    $('#searchData').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

$(document).ready(function() {

    $('#searchData').DataTable();

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
});


</script>
</body>
</html>