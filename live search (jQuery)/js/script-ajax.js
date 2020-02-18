let table = document.getElementById('table');
let keyword = document.getElementById('keyword')

//tambah Event ketika keyword diketik
keyword.addEventListener('keyup', function() {
  //buat object ajax
  let xhr = new XMLHttpRequest()

  xhr.onreadystatechange = function() {
    if( xhr.readyState == 4 && xhr.status == 200 ) {
      table.innerHTML = xhr.responseText
    }
  }

  //eksekusi ajax
  xhr.open('GET', 'ajax/books.php?keyword='+keyword.value, true)
  xhr.send()
})