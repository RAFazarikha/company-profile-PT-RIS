<?php

function generateKeywords($description) {
    // Daftar stop words yang umum dalam bahasa Indonesia/Inggris
    $stopWords = array(
        'yang', 'dan', 'di', 'untuk', 'dengan', 'pada', 'adalah', 'itu', 'ke', 'sebuah', 
        'tersebut', 'oleh', 'atau', 'juga', 'kami', 'mereka', 'anda', 'ini', 'ini', 'dari'
    );

    // Mengubah semua huruf menjadi lowercase untuk konsistensi
    $description = strtolower($description);

    // Menghapus karakter yang tidak diinginkan (seperti tanda baca)
    $description = preg_replace('/[^a-z0-9\s]/', '', $description);

    // Memecah deskripsi menjadi kata-kata
    $words = explode(' ', $description);

    // Array untuk menyimpan kata kunci
    $keywords = array();

    // Menyaring kata-kata yang ada dalam daftar stop words
    foreach ($words as $word) {
        if (!in_array($word, $stopWords) && strlen($word) > 2) {
            $keywords[] = $word;
        }
    }

    // Menghilangkan duplikat (jika ada kata yang sama muncul lebih dari sekali)
    $keywords = array_unique($keywords);

    // Mengembalikan kata kunci dalam format string (comma-separated)
    return implode(', ', $keywords);
}

// // Contoh deskripsi
// $description = "Kami menyediakan berbagai macam produk berkualitas dengan harga terbaik dan pengiriman cepat.";

// $keywords = generateKeywords($description);

// echo "Keywords: " . $keywords;

?>
