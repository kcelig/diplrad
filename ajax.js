

function glavni(file){	  // glavna funkcija - dohvaca datoteku pomocu XMLHttpRequest-a. Prosljedjuje svoj sadrzaj do requestFile varijable
        this.AjaxFailedAlert = "U Vasem pregledniku nije ukljucena opcija za JavaScript.\n"; //obavijest korisniku da preglednik ne podrzava XMLHttpRequest.
        this.requestFile = file;  //drzi datoteku koju ce biti poslana zahtjevom.
        this.method = "POST";  //http metoda POST ili GET (npr. kod rada s formama), po defaultu postavljena na POST
        this.URLString = "";  //lista varijabli i vrijednosti u GET stilu slanja
        this.encodeURIString = true;
        this.execute = false; //postavlja se na TRUE ako se zeli evaluirati response tekst i pokrenuti

        this.onLoading = function() { };  //prosljedjivanje varijable bez argumenata, npr. kod ucitavanja stranice
        this.onLoaded = function() { };  // onLoaded - prosljedjivanje varijable bez argumenata, npr. kod vec ucitane stranice
        this.onInteractive = function() { };  // onInteractive - prosljedjivanje varijable bez argumenata, npr. kod nekog streaming sadrzaja
        this.onCompletion = function() { };  //prosljedjivanje varijable bez argumenata, npr. kod je ucitavanje, streaming zavrsen(o)

        this.kreirajAJAX = function() {  // inicijalizira XMLHttpRequest objekt u pregledniku, aukoliko nije podrzan postavlja failed varijablu na true
                try {
                        this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try {
                                this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (err) {
                                this.xmlhttp = null;
                        }
                }
                if(!this.xmlhttp && typeof XMLHttpRequest != "undefined")
                        this.xmlhttp = new XMLHttpRequest();
                if (!this.xmlhttp){
                        this.failed = true;
                }
        };

        this.postaviVarijablu = function(naziv, value){ //dozvoljava dodavanje varijable za parsiranje unutar URLString-a u paru naziv/value (vrijednost).
                if (this.URLString.length < 3){
                        this.URLString = naziv + "=" + value;
                } else {
                        this.URLString += "&" + naziv + "=" + value;
                }
        }

        this.ukljuciVarijablu = function(naziv, value){
                var varijablaString = encodeURIComponent(naziv) + "=" + encodeURIComponent(value);
        return varijablaString;
        }

        this.encodeURLString = function(string){
                varijablaPolje = string.split('&');
                for (i = 0; i < varijablaPolje.length; i++){
                        urlVarijable = varijablaPolje[i].split('=');
                        if (urlVarijable[0].indexOf('amp;') != -1){
                                urlVarijable[0] = urlVarijable[0].substring(4);
                        }
                        varijablaPolje[i] = this.ukljuciVarijablu(urlVarijable[0],urlVarijable[1]);
                }
        return varijablaPolje.join('&');
        }

        this.pokreniOdziv = function(){
                eval(this.response);
        }

        this.pokreniAJAX = function(urlstring){   // pokrece AJAX zahtjev. Puni varijable s odgovrajacim odzivom (response)
                this.responseStatus = new Array(2);   //polje koje vraca status responsa sa servera. kad je 0 onda je npr. 404, 300... , 1 = opis u tekstualnom obliku
                if(this.failed && this.AjaxFailedAlert){
                        alert(this.AjaxFailedAlert);
                } else {
                        if (urlstring){
                                if (this.URLString.length){
                                        this.URLString = this.URLString + "&" + urlstring;
                                } else {
                                        this.URLString = urlstring;
                                }
                        }
                        if (this.encodeURIString){
                                var timeval = new Date().getTime();
                                this.URLString = this.encodeURLString(this.URLString);
                                this.postaviVarijablu("rndval", timeval);
                        }
                        if (this.element) { this.elementObj = document.getElementById(this.element); }  //element koji ce mijenjati sadrzaj i sl.
                        if (this.xmlhttp) {
                                var vlastita = this;
                                if (this.method == "GET") {
                                        var totalurlstring = this.requestFile + "?" + this.URLString;
                                        this.xmlhttp.open(this.method, totalurlstring, true);
                                } else {
                                        this.xmlhttp.open(this.method, this.requestFile, true);
                                }
                                if (this.method == "POST"){
                                          try {
                                                this.xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
                                        } catch (e) {}
                                }

                                this.xmlhttp.send(this.URLString);
                                this.xmlhttp.onreadystatechange = function() {
                                        switch (vlastita.xmlhttp.readyState){
                                                case 1:
                                                        vlastita.onLoading();
                                                break;
                                                case 2:
                                                        vlastita.onLoaded();
                                                break;
                                                case 3:
                                                        vlastita.onInteractive();
                                                break;
                                                case 4:
                                                        vlastita.response = vlastita.xmlhttp.responseText;   //odgovor (tekst) dohvacen sa servera
                                                        vlastita.responseXML = vlastita.xmlhttp.responseXML;  //odgovor (xml) dohvacen sa servera
                                                        vlastita.responseStatus[0] = vlastita.xmlhttp.status;
                                                        vlastita.responseStatus[1] = vlastita.xmlhttp.statusText;
                                                        vlastita.onCompletion();
                                                        if(vlastita.execute){ vlastita.pokreniOdziv(); }
                                                        if (vlastita.elementObj) {
                                                                var elemNodeName = vlastita.elementObj.nodeName;
                                                                elemNodeName.toLowerCase();
                                                                if (elemNodeName == "input" || elemNodeName == "select" || elemNodeName == "option" || elemNodeName == "textarea"){
                                                                        vlastita.elementObj.value = vlastita.response;
                                                                } else {
                                                                        vlastita.elementObj.innerHTML = vlastita.response;
                                                                }
                                                        }
                                                        vlastita.URLString = "";
                                                break;
                                        }
                                };
                        }
                }
        };
        this.kreirajAJAX();
}



