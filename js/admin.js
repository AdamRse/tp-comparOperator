document.querySelectorAll(".deleteTo").forEach(bt => {
    bt.addEventListener("click", function(){
        if(confirm("Do you really want delete the tour operator "+this.dataset.name+" ?")){
            window.location.href="?s=admin&process&delete_to="+this.dataset.id;
        }
    });
});