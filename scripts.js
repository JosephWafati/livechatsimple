$(document).ready(function(){
    $('#chat-form').submit(function(e){
        e.preventDefault();
        var message = $('#message-input').val();

        $.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { message: message },
            success: function(response) {
                console.log(response); // Optional: Log server response
                $('#message-input').val(''); // Clear input field after sending
                fetchMessages(); // Fetch and display updated messages
            }
        });
    });

    // Function to fetch messages
    function fetchMessages() {
        $.get('backend.php', function(data){
            $('#chat-box').html(data); // Replace chat box content with updated messages
        });
    }

    // Initial fetch on page load
    fetchMessages();

    // Polling every 5 seconds (optional for real-time updates)
    setInterval(fetchMessages, 5000);
});
