//Code navbar
let openConnect = document.querySelector("#openConnect");
if(openConnect){//Test la présence de la navbar, en cas d'absence le code JS ne plante pas et le reste peut s'executer.
    let divNavMenu =  openConnect.querySelector("#divNavMenu");
    let formConnect = divNavMenu.querySelector("#formConnect");

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
            console.log(response);
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