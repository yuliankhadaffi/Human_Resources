<style type="text/css">
    input[type=date] 
    {
        color: azure;
        background-color: transparent;
        text-transform: bold;

    }
    .ttup {color: white;}
    .ttup:hover {color: black; transform: rotate(180deg); 
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg); 
        transition:1s;
        -moz-transition:1s;
        -webkit-transition:1s;
    }
    .bllk{border-radius: 5px; background-color: #536878}
    .bllk:hover{ background-color: tomato; color: black}
</style>
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-blue-grey" style="border-radius: 10px;">
            <button type="button" class="bllk btn btn-sm waves-effect waves-red waves-float pull-right" data-dismiss="modal"><li class="ttup fa fa-times"></li></button>
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">CETAK DATA ANGGOTA PERIODE PENDAFTARAN</h4><hr>
            </div>
            <div class="modal-body">
                <form method="POST" action="pages/report_anggota.php" target="_blank">

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Dari</label>
                                    <input type="date" class="form-control" name="input_tgl" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Hingga</label>
                                    <input type="date" class="form-control" name="input_tgl2" required="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            
            <div class="modal-footer">
                <button  name="cetak" class="btn btn-link btn-block waves-effect waves-cyan">CETAK</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>