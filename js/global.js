let formConnect = document.querySelector("#formConnect");
if(formConnect){
    formConnect.addEventListener("submit", formSubmit);

    function formSubmit(e) {
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