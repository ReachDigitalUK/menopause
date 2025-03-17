/* eslint-disable */
document.addEventListener('DOMContentLoaded',function () {
       
    let link = document.querySelectorAll('.info-modal');

    if (link) {
        for (let i = 0; i < link.length; i++) {
            link[i].addEventListener('click', function (e) {
                // Prevent the default action if it's a link
                e.preventDefault();
    
                let name = link[i].getAttribute('data-name');
                let description = link[i].getAttribute('data-description');
    
                let modal = document.createElement('dialog');
                modal.classList.add('modal');
                modal.innerHTML = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>` + name + `</h2>
                        </div>
                        <div class="modal-body">
                            <p>` + description + `</p>
                        </div>
                        <div class="modal-footer">
                            <button class="close">Close</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                modal.showModal();
    
                // Attach event listener to the close button inside the modal
                let closeButton = modal.querySelector('.close');
                closeButton.addEventListener('click', function () {
                    modal.close();
                    modal.remove(); // Optionally, remove the modal from the DOM after closing
                });
            });
        }
    }
});
