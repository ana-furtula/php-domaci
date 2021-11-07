function includeHTML() {
    var z, i, elmnt, file, xhttp;
    /* Petlja kroz kolekciju svih HTML elemenata: */
    z = document.getElementsByTagName("*");
    for (i = 0; i < z.length; i++) {
      elmnt = z[i];
      /*traženje elementa sa konkretnim atributom:*/
      file = elmnt.getAttribute("w3-include-html");
      if (file) {
        /* Pravljenje HTTP zahtjeva korišćenjem vrijednosti atributa kao naziv fajla */
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4) {
            if (this.status == 200) {elmnt.innerHTML = this.responseText;}
            if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
            /* Uklanjanje atributa i pozivanje ove funkcije još jednom */
            elmnt.removeAttribute("w3-include-html");
            includeHTML();
          }
        }
        xhttp.open("GET", file, true);
        xhttp.send();
        return;
      }
    }
  }