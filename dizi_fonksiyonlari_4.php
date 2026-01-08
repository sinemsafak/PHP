<?php
// array_fill_keys() - Belirli anahtarlarla bir array'yi aynı değerle doldurur
$array_fill = array_fill_keys([1, 2, 3], "örnek");
print_r($array_fill); // Çıktı: Array ( [1] => örnek [2] => örnek [3] => örnek )

// array_filter() - Array'in değerlerini filtreler
$array_filter = array_filter([1, 2, 3, 4, 5], function($value) {
    return $value % 2 == 0;
});
print_r($array_filter); // Çıktı: Array ( [1] => 2 [3] => 4 )

// array_flip() - Anahtarlar ile değerleri yer değiştirir
$array_flip = array_flip([1 => 'a', 2 => 'b']);
print_r($array_flip); // Çıktı: Array ( [a] => 1 [b] => 2 )

// array_intersect() - Birden fazla array'i karşılaştırır ve ortak değerleri döndürür
$array_intersect = array_intersect([1, 2, 3], [3, 4, 5]);
print_r($array_intersect); // Çıktı: Array ( [2] => 3 )

// array_intersect_assoc() - Anahtarlar ve değerlerle karşılaştırma yapar
$array_intersect_assoc = array_intersect_assoc([1 => 'a', 2 => 'b'], [1 => 'a', 3 => 'c']);
print_r($array_intersect_assoc); // Çıktı: Array ( [1] => a )

// array_intersect_key() - Anahtarları karşılaştırır
$array_intersect_key = array_intersect_key([1 => 'a', 2 => 'b'], [1 => 'c', 2 => 'd']);
print_r($array_intersect_key); // Çıktı: Array ( [1] => a [2] => b )

// array_intersect_uassoc() - Anahtarları karşılaştırırken kullanıcı tanımlı fonksiyon kullanır
$array_intersect_uassoc = array_intersect_uassoc([1 => 'a', 2 => 'b'], [1 => 'a', 3 => 'c'], function($a, $b) {
    return strcmp($a, $b);
});
print_r($array_intersect_uassoc); // Çıktı: Array ( [1] => a )

// array_intersect_ukey() - Anahtarları karşılaştırırken kullanıcı tanımlı fonksiyon kullanır
$array_intersect_ukey = array_intersect_ukey([1 => 'a', 2 => 'b'], [1 => 'c', 3 => 'd'], function($a, $b) {
    return $a - $b;
});
print_r($array_intersect_ukey); // Çıktı: Array ( [1] => a )

// array_key_exists() - Array'de belirli bir anahtarın var olup olmadığını kontrol eder
$array_key_exists = array_key_exists(1, [1 => 'a', 2 => 'b']);
var_dump($array_key_exists); // Çıktı: bool(true)

// array_keys() - Array'deki tüm anahtarları döndürür
$array_keys = array_keys([1 => 'a', 2 => 'b']);
print_r($array_keys); // Çıktı: Array ( [0] => 1 [1] => 2 )

// array_map() - Bir array'e callback fonksiyonu uygular
$array_map = array_map(function($value) {
    return $value + 2;
}, [1, 2, 3]);
print_r($array_map); // Çıktı: Array ( [0] => 3 [1] => 4 [2] => 5 )

// array_merge() - Birden fazla array'i tek bir array'de birleştirir
$array_merge = array_merge([1, 2], [3, 4]);
print_r($array_merge); // Çıktı: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 )

// array_merge_recursive() - Birden fazla array'i birleştirirken, aynı anahtarlar için array'leri iç içe ekler
$array_merge_recursive = array_merge_recursive([1, 2], [2, 3]);
print_r($array_merge_recursive); // Çıktı: Array ( [0] => 1 [1] => 2 [2] => 2 [3] => 3 )

// array_multisort() - Birden çok array'i sıralar
$array_multisort = [3, 1, 2];
array_multisort($array_multisort);
print_r($array_multisort); // Çıktı: Array ( [0] => 1 [1] => 2 [2] => 3 )

// array_pad() - Bir array'e belirli bir değere sahip belirli sayıda öğe ekler
$array_pad = array_pad([1, 2], 5, 0);
print_r($array_pad); // Çıktı: Array ( [0] => 1 [1] => 2 [2] => 0 [3] => 0 [4] => 0 )

// array_pop() - Array'deki son öğeyi siler
$array_pop = [1, 2, 3];
array_pop($array_pop);
print_r($array_pop); // Çıktı: Array ( [0] => 1 [1] => 2 )

// array_product() - Array'deki değerlerin çarpımını döndürür
$array_product = array_product([1, 2, 3, 4]);
echo "Çarpım: $array_product\n"; // Çıktı: Çarpım: 24

// array_push() - Bir array'e bir veya daha fazla öğe ekler
$array_push = [1, 2];
array_push($array_push, 3, 4);
print_r($array_push); // Çıktı: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 )

// array_rand() - Array'den rastgele bir anahtar seçer
$array_rand = array_rand([1, 2, 3, 4], 1);
echo "Rastgele anahtar: $array_rand\n"; // Çıktı: Rastgele anahtar: 2 (değişken olabilir)

// array_reverse() - Array'in sırasını tersine çevirir
$array_reverse = array_reverse([1, 2, 3]);
print_r($array_reverse); // Çıktı: Array ( [0] => 3 [1] => 2 [2] => 1 )

// array_search() - Belirtilen değeri array'de arar ve anahtarını döndürür
$array_search = array_search(2, [1, 2, 3]);
echo "Anahtar: $array_search\n"; // Çıktı: Anahtar: 1

// array_shift() - Array'deki ilk öğeyi kaldırır
$array_shift = [1, 2, 3];
array_shift($array_shift);
print_r($array_shift); // Çıktı: Array ( [0] => 2 [1] => 3 )

// array_slice() - Array'in belirli bir kısmını çıkarır
$array_slice = array_slice([1, 2, 3, 4], 1, 2);
print_r($array_slice); // Çıktı: Array ( [0] => 2 [1] => 3 )

// array_splice() - Array'deki belirli öğeleri kaldırır ve değiştirir
$array_splice = [1, 2, 3, 4];
array_splice($array_splice, 1, 2, [5, 6]);
print_r($array_splice); // Çıktı: Array ( [0] => 1 [1] => 5 [2] => 6 [3] => 4 )

// array_sum() - Array'deki değerlerin toplamını döndürür
$array_sum = array_sum([1, 2, 3, 4]);
echo "Toplam: $array_sum\n"; // Çıktı: Toplam: 10

// array_udiff() - Array'leri karşılaştırır ve farklılıkları döndürür
$array_udiff = array_udiff([1, 2, 3], [2, 3, 4], function($a, $b) {
    return $a - $b;
});
print_r($array_udiff); // Çıktı: Array ( [0] => 1 )

// array_walk() - Array'in her elemanına bir kullanıcı fonksiyonu uygular
$array_walk = [1, 2, 3];
array_walk($array_walk, function(&$value) {
    $value *= 2;
});
print_r($array_walk); // Çıktı: Array ( [0] => 2 [1] => 4 [2] => 6 )

// array_walk_recursive() - Array'in her elemanına ve alt elemanlarına bir kullanıcı fonksiyonu uygular
$array_walk_recursive = [1, [2, 3], 4];
array_walk_recursive($array_walk_recursive, function(&$value) {
    $value *= 2;
});
print_r($array_walk_recursive); // Çıktı: Array ( [0] => 2 [1] => Array ( [0] => 4 [1] => 6 ) [2] => 8 )

// asort() - Bir ilişkisel array'i anahtara göre artan sırayla sıralar
$array_asort = [3 => 'c', 1 => 'a', 2 => 'b'];
asort($array_asort);
print_r($array_asort); // Çıktı: Array ( [1] => a [2] => b [3] => c )

// ksort() - Bir ilişkisel array'i anahtara göre artan sırayla sıralar
$array_ksort = [3 => 'c', 1 => 'a', 2 => 'b'];
ksort($array_ksort);
print_r($array_ksort); // Çıktı: Array ( [1] => a [2] => b [3] => c )

// compact() - Değişkenleri bir array gibi toplar
$first = "John";
$last = "Doe";
$age = 30;
$compact = compact("first", "last", "age");
print_r($compact); // Çıktı: Array ( [first] => John [last] => Doe [age] => 30 )
?>
