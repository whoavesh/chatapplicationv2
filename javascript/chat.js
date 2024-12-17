const form = document.querySelector(".typing-area"),
      incoming_id = form.querySelector(".incoming_id").value,
      inputField = form.querySelector(".input-field"),
      sendBtn = form.querySelector("button"),
      chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
  e.preventDefault(); // Prevent the default form submission
};

// Focus the input field and chatbox
inputField.focus();
chatBox.focus();

sendBtn.onclick = () => {
  // Create a new FormData object to include all form elements, including the file
  let formData = new FormData(form);

  // Initialize an XMLHttpRequest to handle AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-chat.php", true); // Change to the file that handles both message and file
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = ""; // Clear the input field after a successful request
        form.querySelector("input[type='file']").value = ""; // Clear the file input
        scrollToBottom(); // Scroll to the bottom of the chat
      }
    }
  };

  xhr.send(formData); // Send the form data, including the file and message
};

// Chatbox scrolling logic
chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

chatBox.ontouchmove = () => {
  chatBox.classList.add("active");
};

// Update chat messages every 500ms
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id=" + incoming_id);
}, 500);

// Function to scroll chatbox to the bottom
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
