$(document).ready(function() {
  //menghilangkan tombol cari
  $('#cari').remove()
  //event bekerja ketika keyword diketik
  $('#keyword').on('keyup', function() {
    //muncul icon loader
    $('#loader').show()

    //ajax menggunakan load
    // $('#table').load('ajax/books.php?keyword='+$('#keyword').val())

    //ajax menggunakan get
    if ($('#keyword').val !== '') {

      $.get('ajax/books.php?keyword=' + $('#keyword').val(), function(data) {
  
        $('#table').html(data)
        $('#loader').hide()
  
      })
    } else {
      $(document).location.href = '/'
    }

  })
})