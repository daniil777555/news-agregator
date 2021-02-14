export class News {
	constructor(){
		this.btnMoreCollection = document.querySelectorAll(".more-text");
		this.init();
	}

	init(){
		this.dateSelector();
		document.querySelector(".select-sort").addEventListener("change", this.sortByDate);
		this.btnMoreCollection.forEach((el) => {
			if (el.previousElementSibling.clientHeight < 100) el.style.display = "none";
			el.addEventListener("click", this.showOrHideMore);
		});
	}

	showOrHideMore(event) {
		if (event.target.innerHTML === "More") {
			event.target.innerHTML = "Less";
			event.target.previousElementSibling.style.maxHeight = "max-content";
		} else {
			event.target.innerHTML = "More";
			event.target.previousElementSibling.style.maxHeight = "100px";
		}
	}

	sortByDate(event){
		let reg = /\?/gmi;
		let reg2 = /sortDate.+?(?=&)|sortDate.+$/gmi;

		//This code change sortDate value, because without this, it will be concatenating of requests of sortDate, indeed if there was request with sortDate
		if(reg2.test(window.location.href)){  
			window.location.href = window.location.href.replace(reg2, event.target.value)
			return
		}

		if(reg.test(window.location.href)){
			window.location += "&" + event.target.value;
		} else{
			window.location = "?" + event.target.value;
		}
	}

	dateSelector(){  // This code saves the value of selector after updating page
		let reg = /sortDate.+?(?=&)|sortDate.+$/gmi;

		//Take url, matched with reg and divide on sortDate and option, returns option name, and searching tag which must be changed
		let selectOption = window.location.href.match(reg);
		 if(selectOption){
			selectOption = selectOption[0].split("=")[1];
			document.querySelector(`.${selectOption}`).setAttribute("selected", "selected");
		}
	}
}
