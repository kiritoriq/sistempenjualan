<div class="col-md-12">
            <div class="table-responsive">
            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed table-bordered" id='tabel'>
                    <thead class="bg-primary">
                        <tr>
                            <th>Kode Transaksi</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang Keluar</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                    <!-- <th>user_id</th> -->

                        
                        </tr>
                    </thead>   
                    <tbody>
                    @foreach($barangs as $b)
                    <?php
                        $nama = substr($b->nama_brg, 7);
                    ?>
                    <tr>
                        <td>{!!$b->kd_transk!!}</td>
                        <td>{!!$b->kd_brg!!}</td>
                        <td>{!!$nama!!}</td>
                        <td>{!!$b->keluar!!}</td>
                        <td>{!!$b->harga!!}</td>
                        <td>{!!$b->tgl!!}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <p style="height: 50px;">&nbsp;</p>
            </div>
            </div>