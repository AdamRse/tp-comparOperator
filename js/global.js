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
    let divsLogoutAuthor = openConnect.querySelector("#divLogoutAuthor");
    let divLogoutTo = openConnect.querySelector("#divLogoutTo");

    divLogoutAuthor.addEventListener("click", logout);
    divLogoutTo.addEventListener("click", logout);
    openConnect.querySelectorAll(".iconConnect").forEach(e => {
        if(e.dataset.menuid){
            e.addEventListener('click', function(){
                toggleMenuNavbar(this.dataset.menuid);
            });
        }
    });

    formConnect.addEventListener("submit", formSubmit);
    
    function formSubmit(e){
        e.preventDefault();
        const formData = new FormData(e.target);
        
        fetch("/ajax/index.php?script=login", {
            method: "POST",
            body: formData,
            headers: {
                "Accept": "application/json",
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`An error occurred: ${response.statusText}`);
            }
            console.log(response.json());
        })
        .catch(error => {
            console.log(error);
        });
    }
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
        
    })
}