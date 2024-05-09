let bees;
//dude i have put like 20 hours into this project. it's staying bees. sorry
document.addEventListener(
    'click',
    function handleClickOutsideBox(event) {
        if (bees && !bees.contains(event.target)) {
            bees.style.visibility = "hidden";
            bees = null;
        }
    }
);


function review() {
    event.stopPropagation();
    
    let reviewCaller = event.target;
    reviewCaller = reviewCaller.querySelector(".reviewBox");
    if (reviewCaller == null) {
        let temp = event.target.closest(".resultBox");
        reviewCaller = temp.querySelector("div");
    }
    
    // if it's the same reviewbox and it's visible already
    if (reviewCaller === bees && reviewCaller.style.visibility === "visible") {
        return;
    }

    // if it's the same reviewbox in general, make it visible
    if (reviewCaller === bees) {
        if (reviewCaller.style.visibility === "visible") {
            reviewCaller.style.visibility = "hidden";
            reviewCaller.style.opacity = "0%";
            bees = null;
            return;
        } else {
            reviewCaller.style.visibility = "visible";
            reviewCaller.style.opacity = "100%";
            return;
        }
    }
    
    // if current reviewBox is different, hide it
    if (bees) {
        bees.style.visibility = "hidden";
        reviewCaller.style.opacity = "0%";
    }
    reviewCaller.style.visibility = "visible";
    reviewCaller.style.opacity = "100%";
    bees = reviewCaller;
}