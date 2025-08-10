<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Support | StreamFlex</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/brand.css" />
    <link rel="stylesheet" href="css/navbar.css" />
  </head>
  <body
    style="background-color: var(--bg-primary); color: var(--text-secondary)"
  >

    <!-- Navbar -->
    <?php require 'navbar.php'; ?>

    <div class="container py-5 mt-5">
      <h1 class="text-center fw-bold text-white mb-5">Contact & Support</h1>

      <div class="row g-4 mb-5">
        <!-- Contact Form -->
        <div class="col-lg-7">
          <div
            class="p-4 rounded-4"
            style="background-color: var(--bg-secondary)"
          >
            <h4 class="mb-3 text-white">Send Us a Message</h4>
            <form id="contactForm">
              <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input
                  id="contactName"
                  style="background-color: var(--bg-tertiary)"
                  type="text"
                  class="form-control text-white border-0"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input
                  id="contactEmail"
                  style="background-color: var(--bg-tertiary)"
                  type="email"
                  class="form-control text-white border-0"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea
                  id="contactMessage"
                  style="background-color: var(--bg-tertiary)"
                  class="form-control text-white border-0"
                  rows="4"
                  required
                ></textarea>
              </div>
              <button
                type="submit"
                class="btn w-100 text-white"
                style="background: var(--gradient-brand-primary); border: none"
              >
                Send Message
              </button>
            </form>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-5">
          <div
            class="p-4 rounded-4 h-100"
            style="background-color: var(--bg-secondary)"
          >
            <h4 class="text-white mb-4">Get in Touch</h4>

            <div class="d-flex align-items-start mb-4">
              <div class="me-3">
                <div
                  class="bg-gradient rounded-circle d-flex justify-content-center align-items-center"
                  style="width: 48px; height: 48px"
                >
                  <i class="bi bi-envelope-fill text-white fs-5"></i>
                </div>
              </div>
              <div>
                <h6 class="mb-1 text-white">Email</h6>
                <a
                  style="color: var(--text-tertiary)"
                  href="mailto:support@streamflex.com"
                  class="text-decoration-none small"
                  >support@streamflex.com</a
                >
              </div>
            </div>

            <div class="d-flex align-items-start mb-4">
              <div class="me-3">
                <div
                  class="bg-gradient rounded-circle d-flex justify-content-center align-items-center"
                  style="width: 48px; height: 48px"
                >
                  <i class="bi bi-telephone-fill text-white fs-5"></i>
                </div>
              </div>
              <div>
                <h6 class="mb-1 text-white">Phone</h6>
                <p style="color: var(--text-tertiary)" class="small mb-0">
                  +880 1644916069
                </p>
              </div>
            </div>

            <div class="d-flex align-items-start mb-4">
              <div class="me-3">
                <div
                  class="bg-gradient rounded-circle d-flex justify-content-center align-items-center"
                  style="width: 48px; height: 48px"
                >
                  <i class="bi bi-whatsapp text-white fs-5"></i>
                </div>
              </div>
              <div>
                <h6 class="mb-1 text-white">WhatsApp</h6>
                <a
                  style="color: var(--text-tertiary)"
                  href="https://wa.me/8801644916069"
                  class="text-decoration-none small"
                  >Chat on WhatsApp</a
                >
              </div>
            </div>

            <div class="d-flex align-items-start mb-4">
              <div class="me-3">
                <div
                  class="bg-gradient rounded-circle d-flex justify-content-center align-items-center"
                  style="width: 48px; height: 48px"
                >
                  <i class="bi bi-geo-alt-fill text-white fs-5"></i>
                </div>
              </div>
              <div>
                <h6 class="mb-1 text-white">Address</h6>
                <p style="color: var(--text-tertiary)" class="small mb-0">
                  Dhaka, Bangladesh
                </p>
              </div>
            </div>

            <div class="d-flex align-items-start">
              <div class="me-3">
                <div
                  class="bg-gradient rounded-circle d-flex justify-content-center align-items-center"
                  style="width: 48px; height: 48px"
                >
                  <i class="bi bi-globe text-white fs-5"></i>
                </div>
              </div>
              <div>
                <h6 class="mb-1 text-white">Website</h6>
                <a
                  style="color: var(--text-tertiary)"
                  href="https://www.streamflex.com"
                  target="_blank"
                  class="text-decoration-none small"
                  >www.streamflex.com</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- faq -->
      <div class="mb-5">
        <h4 class="text-center text-white mb-4">Frequently Asked Questions</h4>
        <div class="accordion" id="faqAccordion">
          <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
              <button
                style="
                  background-color: var(--bg-tertiary);
                  border: 1px solid var(--bg-secondary);
                "
                class="accordion-button text-white"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq1"
              >
                How can I reset my password?
              </button>
            </h2>
            <div
              id="faq1"
              class="accordion-collapse collapse show"
              data-bs-parent="#faqAccordion"
            >
              <div
                style="
                  background-color: var(--bg-secondary);
                  color: var(--text-tertiary);
                "
                class="accordion-body"
              >
                Go to your profile settings, then click “Reset Password” and
                follow the email instructions.
              </div>
            </div>
          </div>
          <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
              <button
                style="
                  background-color: var(--bg-tertiary);
                  border: 1px solid var(--bg-secondary);
                "
                class="accordion-button text-white collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq2"
              >
                How do I cancel my subscription?
              </button>
            </h2>
            <div
              id="faq2"
              class="accordion-collapse collapse"
              data-bs-parent="#faqAccordion"
            >
              <div
                style="
                  background-color: var(--bg-secondary);
                  color: var(--text-tertiary);
                "
                class="accordion-body"
              >
                Head to the billing section and click on “Cancel Subscription”
                beside your active plan.
              </div>
            </div>
          </div>
          <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header">
              <button
                style="
                  background-color: var(--bg-tertiary);
                  border: 1px solid var(--bg-secondary);
                "
                class="accordion-button text-white collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq3"
              >
                Where can I get quick movie help?
              </button>
            </h2>
            <div
              id="faq3"
              class="accordion-collapse collapse"
              data-bs-parent="#faqAccordion"
            >
              <div
                style="
                  background-color: var(--bg-secondary);
                  color: var(--text-tertiary);
                "
                class="accordion-body"
              >
                Message us directly using WhatsApp or the form above for urgent
                support.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php require 'footer.php'; ?>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script defer>
      document
        .getElementById("contactForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          alert(" Your message has been sent!");
          this.reset();
        });
    </script>
  </body>
</html>
