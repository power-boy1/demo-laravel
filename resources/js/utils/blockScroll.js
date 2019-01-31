let positionX = 0;
let positionY = 0;

function stopScrollEvent(event)
{
    event.preventDefault();
    let div = document.getElementById('app');
    div.scrollTo(positionX, positionY);
}

export default function blockScroll(isVisible)
{
    let div = document.getElementById('app');
    if (isVisible) {
        positionX = div.scrollLeft;
        positionY = div.scrollTop;
        div.addEventListener('scroll', stopScrollEvent);
        div.addEventListener('touchmove', stopScrollEvent);
    } else {
        div.removeEventListener('scroll', stopScrollEvent);
        div.removeEventListener('touchmove', stopScrollEvent);
    }
}
