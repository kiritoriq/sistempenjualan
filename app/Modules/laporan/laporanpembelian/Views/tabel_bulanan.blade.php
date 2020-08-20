<div class="col-md-12">
            <div class="table-responsive">
            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed table-bordered" id='tabel'>
                    <thead class="bg-primary">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang Masuk</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                    <!-- <th>user_id</th> -->

                        
                        </tr>
                    </thead>   
                    <tbody>
                    @foreach($barangs as $a)
                    <tr>
                        <td>{!!$a->kd_brg!!}</td>
                        <td>{!!$a->nama!!}</td>
                        <td>{!!$a->masuk!!}</td>
                        <td>{!!$a->beli!!}</td>
                        <td>{!!$a->tgl!!}</td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <p style="height: 50px;">&nbsp;</p>
            </div>
            </div>