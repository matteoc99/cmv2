interact('.dropzone').dropzone({
    accept: '.drag-drop',
    overlap: 0.30,
    ondropactivate: function (event) {
        event.target.classList.add('drop-active')
    },
    ondragenter: function (event) {
        var draggableElement = event.relatedTarget
        var dropzoneElement = event.target

        // feedback the possibility of a drop
        dropzoneElement.classList.add('drop-target')
        draggableElement.classList.add('can-drop')
        // draggableElement.textContent = 'Dragged in'
    },
    ondragleave: function (event) {
        // remove the drop feedback style
        event.target.classList.remove('drop-target')
        event.relatedTarget.classList.remove('can-drop')
        //event.relatedTarget.textContent = 'Dragged out'
    },
    ondrop: function (event) {
        new_parent= $(event.target).data("folder");
        obj = $(event.relatedTarget).data("document")
        callToDocumentMove(obj,new_parent);
    },
    ondropdeactivate: function (event) {
        // remove active dropzone feedback
        event.target.classList.remove('drop-active')
        event.target.classList.remove('drop-target')
    }
})

interact('.drag-drop')
    .draggable({
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
            })
        ],
        autoScroll: true,
        // dragMoveListener from the dragging demo above
        listeners: {move: dragMoveListener}
    })


function dragMouseDown(event) {
    target = event.target
    target = $(target).closest(".drag-drop");
    setTimeout(function () {
        $(target).find("a").on("click", function (e) {
            e.preventDefault();
        });
    }, 300);
}

function closeDragElement(event) {
    target = event.target
    target = $(target).closest(".drag-drop");
    setTimeout(function () {
        $(target).find("a").unbind("click");
    }, 300);
}

function dragMoveListener(event) {
    var target = event.target

    // keep the dragged position in the data-x/data-y attributes
    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

    // translate the element
    target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

    // update the posiion attributes
    target.setAttribute('data-x', x)
    target.setAttribute('data-y', y)
}

$(document).ready(function () {
    $(".drag-drop").each(function () {
        $(this).on("mousedown", dragMouseDown);
        $(this).on("mouseup", closeDragElement);
    });
});
