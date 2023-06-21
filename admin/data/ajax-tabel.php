<?php
require_once '../../assets/basis/kon.php';

if ($_GET['action'] == "table_produk") {
    
    
    $columns = array(
        0 => '#',
        1 => 'Nama',
        2 => 'Kode',
        3 => 'Merek',
        4 => 'Harga Pokok',
        5 => 'Harga Jual',
        6 => 'Stok',
        7 => 'Kategori',
        8 => 'Aksi',
    );
    
    $datacount = mysqli_fetch_assoc(mysqli_query($db,"SELECT count(id_produk) as jumlah FROM produk"));
    
    
    $totalData = $datacount['jumlah'];
   

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];
    
    if (empty($_POST['search']['value'])) {
        // $query = mysqli_query($db,"SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori order by $order $dir LIMIT $limit OFFSET $start");
        $query = mysqli_query($db,"SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori order by id_produk DESC LIMIT 25 OFFSET 0");

        
    } else {
        $search = $_POST['search']['value'];

        $query = mysqli_query($db,"SELECT id_produk,nm_produk,kode_produk,merek,harga_pokok,harga_jual,kategori FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE nm_produk LIKE '%$search%' or kode_produk LIKE '%$search%' or merek LIKE '%$search%' or harga_pokok LIKE '%$search%' or harga_jual LIKE '%$search%' or kategori LIKE '%$search%' order by $order $dir LIMIT $limit OFFSET $start");

        
        $querycount = mysqli_query($db,"SELECT count(id) as jumlah FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE nm_produk LIKE '%$search%' or kode_produk LIKE '%$search%' or merek LIKE '%$search%' or harga_pokok LIKE '%$search%' or harga_jual LIKE '%$search%' or kategori LIKE '%$search%'");
        
       
        $datacount = mysqli_fetch_assoc($query);
        $totalFiltered = $datacount['jumlah'];
    }

    
    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        foreach ($query as $r) {

            $nestedData['#'] = $no;
            $nestedData['nama'] = $r['nm_produk'];
            $nestedData['kode'] = $r['kode_produk'];
            $nestedData['merek'] = $r['merek'];
            $nestedData['harga_pokok'] = $r['harga_pokok'];
            $nestedData['harga_jual'] = $r['harga_jual'];
            $nestedData['stok'] = $r['stok'];
            $nestedData['kategori'] = $r['kategori'];


            $nestedData['aksi'] = "";

            $data[] = $nestedData;
            $no++;
        }
    }


    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );

    echo json_encode($json_data);
}

?>