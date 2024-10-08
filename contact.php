<?php
include_once 'curd-model.php';
$object = new Customers();
$contactData = $object->getAppContactInfo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starling bags-NI | Contact Us</title>
    <link rel="icon" href="./assets/faviconlogo.svg" type="image/x-icon">
    <meta property="og:site_name" content="Starling bags-NI | Personalized Bags" />
    <meta property="og:title" content="Starling bags-NI | customizable bags, promotional bags, eco-friendly bags" />
    <meta property="og:image" content="https://starlingbagsni.co.uk/assets/starlinglogo.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<style>
    .swal2-modal {
        background-color: #e8f0f0 !important;
        color: #000 !important;
    }
</style>

<body>
    <?php include("header.php") ?>

    <div class="contact_page">
        <h1>Contact us</h1>

        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-lg-6 ctc_form">
                        <form action="" class="myform" id="contactForm" novalidate>
                            <h3 class="mb-3"> Get in Touch</h3>

                            <div class="form-quote_input">
                           <input type="text" placeholder=" " name="ctc_person_name" id="customerName" required pattern="[a-zA-Z\s]+" title="Name should only contain letters and spaces">
                           <label for="customerName">Name *</label>
                           <small>Please enter a valid name (letters only).</small>
                           </div>

                         <div class="form-quote_input mt-3">
                         <input type="email" placeholder=" " name="ctc_person_email" id="customerEmail" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address">
                         <label for="customerEmail">Email *</label>
                         <small>Please enter a valid email address.</small>
                         </div>

                            <div class="form-quote_input mt-3">
                                <input type="tel" placeholder=" " minlength="10" maxlength="11" name="ctc_person_phno" id="customerPhoneNumber" required>
                                <label for="customerPhoneNumber">Phone number *</label>
                                <small>Please enter your phone number.</small>
                            </div>

                            <div class="form-quote_input mt-3">
                                <textarea name="ctc_person_msg" placeholder=" " id="customerMessage"></textarea>
                                <label for="customerMessage">Message</label>
                            </div>

                            <div class="ctc_smt mt-3">
                                <button type="submit" id="submit">
                                    <span class="pe-1">Send a message</span>
                                    <?php include("./loaderAnimation.php") ?>
                                </button>
                            </div>

                            <input type="hidden" name="action" value="insert" />
                        </form>
                    </div>

                    <div class="col-lg-6 ctc_rgt">
                        <div class="ctc_img">
                            <img src="assets/images/ctc img.jpg" alt="contact_me">
                        </div>

                        <div class="add_info">
                            <?php if (!empty($contactData['address'])): ?>
                                <div class="cmny_loc">
                                    <div>
                                        <img src="assets/images/location_icon.png" alt="">
                                        <span><?= $contactData['address']; ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($contactData['phone_number'])): ?>
                                <div class="cmny_phone">
                                    <a href="tel:<?= $contactData['phone_number']; ?>">
                                        <img src="assets/images/phone_icon.png" alt="">
                                        <span><?= $contactData['phone_number']; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($contactData['email_id'])): ?>
                                <div class="cmny_email">
                                    <a href="mailto:<?= $contactData['email_id']; ?>">
                                        <img src="assets/images/mail_icon.png" alt="">
                                        <span><?= $contactData['email_id']; ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($contactData['facebook_link']) || !empty($contactData['twitter_link']) || !empty($contactData['instagram_link'])): ?>
                    <div class="social_link">
                        <ul>
                            <?php if (!empty($contactData['facebook_link'])): ?>
                                <li><a href="<?= $contactData['facebook_link']; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <?php endif; ?>

                            <?php if (!empty($contactData['twitter_link'])): ?>
                                <li><a href="<?= $contactData['twitter_link']; ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            <?php endif; ?>

                            <?php if (!empty($contactData['instagram_link'])): ?>
                                <li><a href="<?= $contactData['instagram_link']; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include("footer.php") ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
     $(document).ready(function() {
    resetForm();

    function resetForm() {
        $(".myform")[0].reset();  // Reset the form on page load
    }

    // Handle form submission
    $(document).on('submit', '#contactForm', function(e) {
        e.preventDefault();  // Prevent default form submission behavior

        var form = this;
        var formData = new FormData(form);  // Gather form data

        if (form.checkValidity()) {  // Check if form inputs are valid
            $('#submit').prop("disabled", true);  // Disable the submit button to prevent multiple clicks
            $('.loaderMainContainer').css("display", "inline-block");  // Show loader animation

            // Show a processing message while waiting for the response
            Swal.fire({
                title: "Processing...",
                text: "Please wait while we process your request.",
                icon: "info",
                showConfirmButton: false  // Show a loading message without a button
            });

            // Proceed with the actual AJAX form submission
            $.ajax({
                url: "ajaxcallfunctions.php",  // Replace with correct PHP file handling the form
                method: "POST",  // POST method to submit data
                data: formData,  // Submit the form data using FormData object
                contentType: false,  // Required for FormData
                processData: false,  // Prevent jQuery from processing the data
                cache: false,  // Disable cache for this request
                success: function(response) {
                    console.log(response);
                    $('#submit').prop("disabled", false);  // Re-enable the submit button after the response
                    $('.loaderMainContainer').css("display", "none");  // Hide the loader

                    if (response.trim() == '1') {
                        // Success response handling
                        Swal.fire({
                            title: "Thank you!",
                            text: "Your message has been successfully sent.",
                            icon: "success",
                            confirmButtonText: "Close"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();  // Reload page after user closes success dialog
                            }
                        });
                    } else {
                        // Error or validation failure handling
                        Swal.fire({
                            title: "Oops..?",
                            text: "There was a problem submitting the form. Please check your inputs.",
                            icon: "info"
                        });
                        $('.myform').show();  // Show the form again for corrections
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);  // Log error for debugging
                    $('#submit').prop("disabled", false);  // Re-enable the submit button after error
                    $('.loaderMainContainer').css("display", "none");  // Hide the loader
                    $('.myform').show();  // Show the form again in case of an error

                    // Show an error message
                    Swal.fire({
                        title: "Error",
                        text: "There was an issue submitting the form. Please try again later.",
                        icon: "error"
                    });
                }
            });
        } else {
            // If the form is invalid, show real-time validation feedback
            form.classList.add('was-validated');  // Add Bootstrap validation class
        }
    });
});
    </script>
</body>
</html>
