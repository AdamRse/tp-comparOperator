document.querySelectorAll(".deleteTo").forEach(bt => {
    bt.addEventListener("click", function(){
        if(confirm("Do you really want delete the tour operator "+this.dataset.name+" ?")){
            window.location.href="?s=admin&process&delete_to="+this.dataset.id;
        }
    });
});
document.querySelectorAll(".deleteAuthor").forEach(bt => {
    bt.addEventListener("click", function(){
        if(confirm("Do you really want delete the author "+this.dataset.name+" with all its reviews ?")){
            window.location.href="?s=admin&process&delete_author="+this.dataset.id;
        }
    });
});