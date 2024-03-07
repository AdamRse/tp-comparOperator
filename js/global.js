//Fonctions
async function getFetch(script, rq = false){
    if(rq){
        rq = rq[0]!="&" ? "&"+rq : "";
    }
    else
        rq = "";
    const reponse = await fetch("/ajax/index.php?script="+script+rq);
    const rt = await reponse.json();
    return rt;
}
//Code navbar
let openConnect = document.querySelector("#openConnect");
if(openConnect){//Test la présence de la navbar, en cas d'absence le code JS ne plante pas et le reste peut s'executer.
    let divNavMenu =  openConnect.querySelector("#divNavMenu");
    let formConnect = divNavMenu.querySelector("#formConnect");
    let spanReturnMessage = formConnect.querySelector("#spanReturnMessage");
    let nomSession = openConnect.querySelector("#nomSession");

    //Log out quand on clique sur la div
    openConnect.querySelectorAll(".divLogout").forEach(e => {
        e.addEventListener("click", logout);
    });

    //Toggle du menu de la navbar en cliquant su l'icone
    openConnect.querySelectorAll(".iconConnect").forEach(e => {
        if(e.dataset.menuid){
            e.addEventListener('click', function(){
                toggleMenuNavbar(this.dataset.menuid);
            });
        }
    });

    //Envoi du formulaire de connexion
    formConnect.addEventListener("submit", formSubmit);


    //Fonctions spécifiques à la navbar
    function formSubmit(e){
        e.preventDefault();
        let name = formConnect.querySelector('#formConnectName').value;
        let pw = formConnect.querySelector('#formConnectPw').value;
        getFetch("login", "name="+name+"&password="+pw).then((response) => {
            console.log(response);
            if(response.error){
                spanReturnMessage.innerHTML = response.error.message;
                setTimeout(() => {
                    spanReturnMessage.innerHTML = "";
                }, 4000);
            }
            else{
                divNavMenu.classList.add("d-none");
                formConnect.querySelector('#formConnectName').value = "";
                formConnect.querySelector('#formConnectPw').value = "";
                nomSession.innerHTML = response.name;
                openConnect.querySelectorAll(".iconConnect").forEach(e => {
                    if(e.dataset.type){
                        if(e.dataset.type == response.type){
                            e.classList.remove("d-none");
                        }
                        else{
                            e.classList.add("d-none");
                        }
                    }
                });
            }
        });
    }
    function toggleMenuNavbar(idDivMenuShow){
        if(divNavMenu.classList.contains("d-none")){
            for (const child of divNavMenu.children) {
                if(child.id == idDivMenuShow)
                    child.classList.remove("d-none");
                else
                    child.classList.add("d-none");
            }
            divNavMenu.classList.remove("d-none");
        }
        else
            divNavMenu.classList.add("d-none");
    }
    function logout(){
        getFetch("login", "dc").then(response => {
            if(response){
                divNavMenu.classList.add("d-none");
                nomSession.innerHTML = "Guest";
                openConnect.querySelectorAll(".iconConnect").forEach(e => {
                    if(e.dataset.type){
                        if(e.dataset.type == "guest"){
                            e.classList.remove("d-none");
                        }
                        else{
                            e.classList.add("d-none");
                        }
                    }
                });
            }
        })
    }
}