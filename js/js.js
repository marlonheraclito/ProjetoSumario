function sair() {
    var r = confirm("Voce quer sair ?");
    if(r) {
      window.location.href = '../controle/logout.php'
    }
  }