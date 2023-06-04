


<div class="ContentHolder" align="left">
   <div class="container" style="width:100%;">
       <h1>Downloads</h1>
       <table class="table table-striped">
           <thead>
               <tr>
                   <th>Title</th>
                   <th>File</th>
               </tr>
           </thead>
           <tbody>
               <?
                    $g = $this->db->query("SELECT * FROM site_manager")->result();
                    foreach($g as $get)
                    //while($g = $get->fetch_assoc())
                    {
                        echo '<tr>
                            <td><a href="uploads/site_manager/'.$g->file.'" target="_blank"><i class="fa fa-download"></i> '.$g->title.'</a></td>
                            <td><a class="btn btn-success" href="download_file.php?file='.$g->file.'" target="_blank"><i class="fa fa-download"></i></a></td>
                        </tr>';
                    }
               ?>
           </tbody>
       </table>
   </div>
</div>