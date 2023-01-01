jQuery(document).ready(function () {
  const searchCompanyInput = document.getElementById("search-company-input");

  jQuery(searchCompanyInput).on("keyup", function () {
    let url = window.origin;
    url += "/wp-json/select-company/search-company";
    const data = { "company-name": jQuery(this).val() };
    jQuery("#autocomplete-results").text("");

    jQuery.get(url, data, function (companies) {
      jQuery("#autocomplete-results").text("");
      for (let i = 0; i < companies.length; i++) {
        const company = companies[i];
        const textRow = `<li class="result-item" key="${company.id}">${company.name}</li>`;
        jQuery("#autocomplete-results").append(textRow);
      }
      // auto complete function
      jQuery(".result-item").on("click", function () {
        let companyName = jQuery(this).text();
        jQuery("#search-company-input").val(companyName);
        jQuery(".company-id-input-field input").val(jQuery(this).attr("key"));
        jQuery("#autocomplete-results").text("");

        // change company name
        let elementsTochangeCompanyName = [
          "business_relationship",
          "vendor_turnover",
          "radio_18_selection",
          "payment_terms",
          "payments_received",
        ];

        for (let i = 0; i < elementsTochangeCompanyName.length; i++) {
          const element = elementsTochangeCompanyName[i];
          let currentText = jQuery(`.${element} .gfield_label`).text();
          jQuery(`.${element} .gfield_label`).text(
            currentText.replace(/{.*}/, companyName)
          );
        }

        let currentText = jQuery(`.stakeholders .gsection_title`).text();
        jQuery(`.stakeholders .gsection_title`).text(
          currentText.replace(/{.*}/, companyName)
        );
      });
    });
  });
});
