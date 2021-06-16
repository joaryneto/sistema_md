<div class="container">
                    <h6 class="page-subtitle">Popular food <a href="#" class="btn btn-sm float-right px-0">View all</a></h6>
                    <div class="row">
					 <?
					 
					 $SQL = "SELECT * FROM produtos;";
					 $RES = mysqli_query($db,$SQL);
					 while($row = mysqli_fetch_array($RES))
					 {
						 
					 ?>
                        <div class="col-6 col-md-3">
                            <div class="card border-0 shadow-light text-center mb-4">
                                <div class="card-body position-relative">
                                    <div class="top-right mt-2"><button class="btn btn-link text-danger p-0"><i class="material-icons text-danger vm">favorite</i></button></div>
                                    <div class="h-100px position-relative overflow-hidden">
                                        <div class="background background-h-100">
                                            <img src="template/images/banner.png" alt="">
                                        </div>
                                    </div>
                                    <h6 class="text-default"><? echo $row['descricao'];?></h6>
                                    <p class="small">Delicious Taste <br><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span><span class="text-warning icon_star"></span></p>
                                    <div class="row">
                                        <div class="col text-left">
                                            <p class="text-success my-0"><? echo number_format($row['preco'], 2, ',','.');?></p>
                                        </div>
                                        <div class="col-auto"><button class="btn btn-sm btn-link text-default p-0"><i class="material-icons">shopping_basket</i></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<? } ?>
                 </div>
             </div>
			 <?


$handle = printer_open("\\192.168.0.8\Canon MF4320-4350");
printer_set_option($handle, PRINTER_MODE, "RAW");
printer_write($handle, "TEXT To print");
printer_close($handle);

			 ?>