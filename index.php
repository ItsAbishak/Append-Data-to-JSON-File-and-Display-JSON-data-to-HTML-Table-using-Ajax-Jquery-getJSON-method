 <?php  
 $message = '';  
 $error = '';  
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["name"]))  
      {  
           $error = "<label class='text-danger'>Enter Name</label>";  
      }  
      else if(empty($_POST["gender"]))  
      {  
           $error = "<label class='text-danger'>Enter Gender</label>";  
      }  
      else if(empty($_POST["designation"]))  
      {  
           $error = "<label class='text-danger'>Enter Designation</label>";  
      }  
      else  
      {  
           if(file_exists('employee_data.json'))  
           {  
                $current_data = file_get_contents('employee_data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name'               =>     $_POST['name'],  
                     'gender'          =>     $_POST["gender"],  
                     'designation'     =>     $_POST["designation"]  
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('employee_data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      }  

 }  
 ?>

<!DOCTYPE html>  
 <html>  
      <head>  
        <meta name="viewport" content="width=device-width, initial-scale=1">

           <title>Abishak Sharma - Append Data to JSON File using PHP</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <h3 align="">Append Data to JSON File</h3><br />                 
                <form method="post">  
                     <?php   
                     if(isset($error))  
                     {  
                          echo $error;  
                     }  
                     ?>  
                     <br />  
                     <label>Name</label>  
                     <input type="text" name="name" class="form-control" /><br />  
                     <label>Gender</label>  
                     <input type="text" name="gender" class="form-control" /><br />  
                     <label>Designation</label>  
                     <input type="text" name="designation" class="form-control" /><br />  
                     <input type="submit" name="submit" value="Append" class="btn btn-info" /><br />                      
                     <?php  
                     if(isset($message))  
                     {  
                          echo $message;  
                     }  
                     ?>  
                </form>  
     

           </div>            <div class="container" style="width:500px;">  


                               <div class="table-responsive">
                  <h1>Details</h1>
                  <br />
                    <table class="table table-bordered table-striped" id="employee_table">
                      <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Designation</th>

                      </tr>

                    </table>
           </div> 
         </div>
           <br />  
      </body>


      <script>
$( document ).ready(function() {
 $.getJSON("employee_data.json", function(data){ 
     var employee_data = '';
      $.each(data, function(key, value){
          employee_data += '<tr>';
          employee_data += '<td>'+value.name+'</td>';
          employee_data += '<td>'+value.gender+'</td>';
          employee_data += '<td>'+value.designation+'</td>';
          employee_data += '</tr>';


      });
      $('#employee_table').append(employee_data);    


  });

 });



 </script>   
 </html>  