const { News } = require("./News");

export class App {
    constructor() {
		this.main();
		this.news = new News();
	}

    main() {
        window.onload = function () {
			if(!sessionStorage.getItem('hello')){
				document.querySelector(".hello").style.display = "block";
				setTimeout(() => {
					document.querySelector(".hello").style.display = "none";
					sessionStorage.setItem('hello', 'true');
				}, 3500)
			}
		};
    }

}
