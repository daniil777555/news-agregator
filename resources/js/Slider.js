export class Slider{
    constructor(){
        this.imagesBlock = document.querySelectorAll(".images-block");
        this.isAddedEvents = false; //I do not know exactly why event listener for closing slider is not removed, 
        //but as I understood it is because Slider object is different from that I bound.
        this.imagesArr = [];
        this.numOfSelectedImg = 0;

    }

    init(){
        this.imagesBlock.forEach(el => el.addEventListener("click", this.openSlider.bind(this))); 
    }

    openSlider(event){
        let sliderBlock = null;
        //These two blocks need for if click will be on the gap between images
        if(event.target.tagName === "IMG"){
            sliderBlock = event.target.parentNode.parentNode.parentNode;
            event.target.parentNode.parentNode.classList.add("images-block-in-slider");
        }

        else if(event.target.tagName === "DIV"){
            sliderBlock = event.target.parentNode;
            event.target.classList.add("images-block-in-slider");
        }

        sliderBlock.classList.add("images-block-wrapper-to-slider");

        this.imagesArr = sliderBlock.querySelectorAll(".image-block");
        this.imagesArr.forEach((image, key) => {
            if(key !== 0) image.style.display = "none";
        })

        let leftBtn = null;
        let rightBtn = null;

        if(this.imagesArr.length > 1){
            leftBtn = sliderBlock.querySelector(".left");
            rightBtn = sliderBlock.querySelector(".right");
            leftBtn.parentNode.classList.remove("slider-btn-none");
            rightBtn.parentNode.classList.remove("slider-btn-none");
        }
        

        this.initSlider(leftBtn,
            rightBtn,
            sliderBlock
        );
    }

    initSlider(leftBtn, rightBtn, sliderBlock){
        if(this.isAddedEvents === false) {
            if(leftBtn && rightBtn){
                leftBtn.addEventListener("click", this.leftClick.bind(this));
                rightBtn.addEventListener("click", this.rightclick.bind(this));
            }
            sliderBlock.addEventListener("click", this.closeSlider.bind(this, leftBtn, rightBtn, sliderBlock));
            this.isAddedEvents = true;
        }
        return
    }

    leftClick(){
        if(this.numOfSelectedImg !== 0){
            this.imagesArr[this.numOfSelectedImg].style.display = "none";
            this.imagesArr[--this.numOfSelectedImg].style.display = "block";
        }
    }

    rightclick(){
        if(this.numOfSelectedImg !== this.imagesArr.length - 1){
            this.imagesArr[this.numOfSelectedImg].style.display = "none";
            this.imagesArr[++this.numOfSelectedImg].style.display = "block";
        }

    }

    closeSlider(leftBtn, rightBtn, sliderBlock, event){
        if(event.target === sliderBlock){
            this.imagesArr.forEach((image, key) => {
                if(key <= 3) image.style.display = "block";
            })
            sliderBlock.classList.remove("images-block-wrapper-to-slider");
            sliderBlock.querySelector(".images-block").classList.remove("images-block-in-slider");
            leftBtn.parentNode.classList.add("slider-btn-none");
            rightBtn.parentNode.classList.add("slider-btn-none");
        }
    }

}