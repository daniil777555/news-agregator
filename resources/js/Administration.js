export class Administration{
    constructor(){
        this.init();
    }

    init(){
        document.querySelectorAll(".delete-news")
            .forEach(el => el.addEventListener("click", this.deleteNews)); 
    }


    deleteNews(event){
        let id = event.target.value;
        let _token = document.querySelector("input[name='_token']").value
        fetch(`/administration/${id}`, {
            headers: {
                'X-CSRF-TOKEN': _token
            },
            method: 'DELETE',
            body: `${_token}`
        })
            .then(() => window.location.reload())
    }
}