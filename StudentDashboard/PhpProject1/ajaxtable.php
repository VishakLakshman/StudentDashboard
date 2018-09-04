<html>
    <head>
        
    </head>
    <body>
<?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
                            
                                                
        class formRows extends RecursiveIteratorIterator { 
        function __construct($it) { 
           parent::__construct($it, self::LEAVES_ONLY); 
           }

        function current() {
           return "<option value='" . parent::current(). "'>". parent::current();
        }


        function endChildren() { 
          echo "</option>" . "\n";
          } 
        }
        
        class TableRows extends RecursiveIteratorIterator { 
        
        function __construct($it) { 
            parent::__construct($it, self::LEAVES_ONLY); 
            }

        function current() {
            return "<td>" . parent::current(). "</td>";
            }

        function beginChildren() { 
            echo "<tr>"; 
            } 

        function endChildren() { 
            echo "</tr>" . "\n";
            } 
        }

        
        $conn = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $page=$_GET['page'];
        
        if($page == 'table')
        {
        $id=$_GET['id'];
        $q = $_GET['q'];
        if($id == "selecttable")
        {
        echo "<option value='a' disabled selected>Select a column(sorting preference)</option>";    
        
        $getAllColumns= $conn->prepare("select COLUMN_NAME from information_schema.columns where table_name = '$q' and TABLE_SCHEMA = 'mydb';");
        $getAllColumns->execute();
                            
        $allColumns = $getAllColumns->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new formRows(new RecursiveArrayIterator($getAllColumns->fetchAll())) as $k=>$v) { 
        echo $v;
        }
        }
        else
        {
            if($id == 'loadtable')
            {
              echo "<option value='a' disabled selected>Select a table</option>";
              
              $getAllTheTables= $conn->prepare("show tables;");
              $getAllTheTables->execute();
                            
              $allTables = $getAllTheTables->setFetchMode(PDO::FETCH_ASSOC); 
              foreach(new formRows(new RecursiveArrayIterator($getAllTheTables->fetchAll())) as $k=>$v) { 
                   echo $v;
             }                            
             echo "</option>";
            }
            else
            {
                
                echo "<div class='header'><h4 class='title'>$q table</h4></div>";
                
                echo "<div class='content table-responsive table-full-width'>
                           <table class='table table-hover table-striped'>";
                
                $getAllColumns= $conn->prepare("select COLUMN_NAME from information_schema.columns where table_name = '$q' and TABLE_SCHEMA = 'mydb';");
                $getAllColumns->execute();
                            
                
                $allColumns=$getAllColumns->fetchAll();
                
                echo "<tr>";
                foreach($allColumns as $row)
                {
                    echo "<th>".$row['COLUMN_NAME']."</th>";
                }
                
                echo "</tr>";
                if($id !='a')
                    $getTable= $conn->prepare("select * from $q order by $id");
                else
                    $getTable= $conn->prepare("select * from $q ");
                
                $getTable->execute();
                
 
                               
                $loadedTable = $getTable->setFetchMode(PDO::FETCH_ASSOC); 
                 foreach(new TableRows(new RecursiveArrayIterator($getTable->fetchAll())) as $k=>$v) { 
                                echo $v;
                     }
                echo "</table></div>";     
                            
            }   
                
         }
        }
        else
        {
            if($page == 'event')
            {
                $type=$_GET['type'];
                if($type == 'getcategory')
                {
                   echo "<option value='a' disabled selected>Select a category</option>";    
        
                   $getCategory= $conn->prepare("select CategoryName from category");
                   $getCategory->execute();
                            
                   $allCategory = $getCategory->setFetchMode(PDO::FETCH_ASSOC);
                   foreach(new formRows(new RecursiveArrayIterator($getCategory->fetchAll())) as $k=>$v) { 
                   echo $v;
                   }
                   
                    
                }
                else
                  if($type == 'insert')
                  {
                      $startdate=$_GET['sdate'];
                      $enddate=$_GET['edate'];
                      $location=$_GET['loc'];
                      $category=$_GET['cat'];
                      
                      echo $category;
                      try
                      {
                      $getCategoryId= $conn->prepare("select ID from category where CategoryName='$category'");
                      $getCategoryId->execute();
                            
                      $res = $getCategoryId->fetch();
                      echo $res['ID'];
                      $categoryid = intval($res['ID']);    
                      
                      $insertevent = "Insert into event (StartDate,EndDate,Location,categoryId) values('$startdate','$enddate','$location',$categoryid)";
                      $conn->exec($insertevent);
                      
                      
                      
                      }
                      catch (PDOException $e)
                      {
                          echo $insertevent . "<br>" . $e->getMessage();
                      }
                  }
                  else
                      if($type == 'load')
                      {
                       
                          $getevent = $conn->prepare("select ID from event order by ID desc");
                          $getevent->execute();
                      
                          $allevent = $getevent->fetchAll();
                          foreach($allevent as $row){
                                echo "<div class='alert alert-info'><button type='button' aria-hidden='true' id ='".$row['ID']."' class='close' onclick='alertme(this.id)'>×</button>";
                                echo "<span><b> Event ". $row['ID'] ." </b></span></div>";
                          }
                           
                          
                      }
                      else
                      {
                          $sql = "DELETE FROM Event WHERE ID=$type";

                          // use exec() because no results are returned
                          $conn->exec($sql);
                          
                          $getevent = $conn->prepare("select ID from event order by ID desc");
                          $getevent->execute();
                      
                          $allevent = $getevent->fetchAll();
                          foreach($allevent as $row){
                                echo "<div class='alert alert-info'><button type='button' aria-hidden='true' id ='".$row['ID']."' class='close' onclick='alertme(this.id)'>×</button>";
                                echo "<span><b> Event ". $row['ID'] ." </b></span></div>";
                          }
                          
                          
                      }
           
           
                
                
 
            }
        }
        
         $con=null;
                            
        
?>
    </body>
</html>