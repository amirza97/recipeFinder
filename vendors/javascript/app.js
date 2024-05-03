// Recipe finder applictaion code with errors

//---------------------------------------------------- Document ready ----------------------------------------------------//
$(document).ready(function() {
    var initialTab = $('.nav-link.active').attr('id');
    updateUI(initialTab);
    $('.nav-link').on('click', function() {
        var activeTab = $(this).attr('id');
        updateUI(activeTab);
        clearSearchResults(); // Clears the results whenever a tab is clicked.
    });
});

//---------------------------------------------------- Search bar and tab functions ----------------------------------------------------//
   
function updateUI(activeTabId) {
    updateSearchPlaceholderAndAction(activeTabId);
    toggleRecipeSubTabs(activeTabId);
    toggleNutritionSearch(activeTabId === 'by-nutrition-tab');
}

function updateSearchPlaceholderAndAction(activeTabId) {
    const tabSettings = {
        'recipes-tab': {
            placeholder: 'Search recipe by ingredient...',
            actionUrl: 'vendors/php/recipeByIngredient.php',
            validationMessage: 'Please enter a valid ingredient',
            showSearchBar: true
        },
        'by-nutrition-tab': {
            placeholder: '', // No placeholder needed, input is hidden
            actionUrl: '',
            validationMessage: '',
            showSearchBar: false
        },
        'ingredients-tab': {
            placeholder: 'Search ingredients...',
            actionUrl: 'vendors/php/searchIngredient.php',
            validationMessage: 'Please enter a valid ingredient',
            showSearchBar: true
        },
        'cuisines-tab': {
            placeholder: 'Search cuisines...',
            actionUrl: 'path/to/searchCuisines.php',
            validationMessage: 'Please enter a valid cuisine type',
            showSearchBar: true
        },
        'groceries-tab': {
            placeholder: 'Search groceries...',
            actionUrl: 'path/to/searchGroceries.php',
            validationMessage: 'Please enter a valid grocery item',
            showSearchBar: true
        }
    };

    const settings = tabSettings[activeTabId] || {
        placeholder: '',
        actionUrl: '',
        validationMessage: '',
        showSearchBar: true
    };

    $('#searchInp')
        .val('')
        .attr('placeholder', settings.placeholder)
        .data('action', settings.actionUrl)
        .attr('oninvalid', `this.setCustomValidity('${settings.validationMessage}')`)
        .attr('oninput', "setCustomValidity('')")
        .closest('.input-group').toggle(settings.showSearchBar); // Toggles the visibility of the search bar.

    handleSearch(settings.actionUrl);
}
   
function toggleNutritionSearch(showNutritionSearch) {
    $('#byNutrition').toggle(showNutritionSearch);
    $('#searchInp').closest('.input-group').toggle(!showNutritionSearch);
}


$('#nutritionSearchBtn').on('click', function() {
    // Implement the logic to perform a search based on the dropdowns and input value
    var dropdown1Value = $('#nutritionDropdown1').val();
    var dropdown2Value = $('#nutritionDropdown2').val();
    var inputValue = $('#nutritionInput').val().trim();
    console.log(dropdown1Value, dropdown2Value, inputValue);  // Replace with actual search functionality
});


function handleSearch(actionUrl) {
    $('#searchBtn').off('click').on('click', function() {
        var query = $('#searchInp').val().trim(); // Ensure whitespace is trimmed
        if ($('#searchInp')[0].checkValidity() && query) { // Checks if the input is valid and not empty
            if (actionUrl === 'vendors/php/recipeByIngredient.php') {
                window[actionUrl](query);
                searchRecipesByIngredients(query, 25); // Assuming '25' is your default number of results
            } else if (actionUrl === 'vendors/php/searchIngredient.php') {
                searchIngredients(query, 25);
            }
        } else {
            $('#searchInp')[0].reportValidity(); // This will trigger the browser's default error popup if the input is invalid
        }
    });
}

function toggleRecipeSubTabs(activeTabId) {
    const isRecipeTab = activeTabId === 'recipes-tab' || activeTabId.includes('by-');
    $('#recipeSubTabsContainer').toggle(isRecipeTab);
}

function clearSearchResults() {
    $('#searchResults').html(''); // Clear search results
    $('#ingredientsResults').html(''); // Clear ingredients results
    $('#cuisinesResults').html(''); // Clear cuisines results
    $('#groceriesResults').html(''); // Clear groceries results
}

updateSearchPlaceholderAndAction($('.nav-link.active').attr('id'));


//---------------------------------------------------- AJAX calls for all tabs ----------------------------------------------------//

// Recipe > ingredients tab
function searchRecipesByIngredients(ingredient, numberOfResults) {
    $.ajax({
        url: 'vendors/php/recipeByIngredient.php', // Ensure this is the correct path
        type: 'GET',
        data: {
            foodIngredient: ingredient,
            numberOfResults: numberOfResults
        },
        dataType: 'json',
        success: function(response) {
            var inputElement = $('#searchInp')[0];
            $('#searchResults').empty(); // Clear previous results

            if (response && response.data && Array.isArray(response.data) && response.data.length > 0) {
                var tableHtml = '<table class="table" style="font-size: 18px;"><thead><tr><th style="width: 10%; vertical-align: middle;">No.</th><th style="width: 60%; vertical-align: middle;">Recipe Name</th><th style="width: 30%; text-align: right; vertical-align: middle;"></th></tr></thead><tbody>';
                $('#searchResults').html(tableHtml);

                response.data.forEach(function(recipe, index) {
                    var rowNumber = index + 1;
                    var capitalisedRecipeName = recipe.title.charAt(0).toUpperCase() + recipe.title.slice(1).toLowerCase(); // Capitalize first letter of recipe title
                    var imageHtml = recipe.image ? `<img src="${recipe.image}" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-left: auto;">` : '<img src="path/to/default/image.jpg" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-left: auto;">';
                    var rowHtml = $(`<tr style="opacity: 0; vertical-align: middle;" class="clickable-row" data-id="${recipe.id}" data-title="${recipe.title}">
                                      <td><strong>${rowNumber}</strong></td><td>${capitalisedRecipeName}</td><td style="text-align: right;">${imageHtml}</td></tr>`);

                    // Append the row to the table and animate opacity with a shorter delay
                    rowHtml.appendTo('#searchResults tbody')
                           .delay(index * 10)
                           .animate({ opacity: 1 }, 250); // Smooth transition to full opacity over 250ms
                });

                $('#searchResults').append('</tbody></table>');
                inputElement.setCustomValidity('');
            } else {
                $('#searchResults').html('');
                inputElement.setCustomValidity(ingredient + ' does not match any recipes. Please enter a valid ingredient.');
                inputElement.reportValidity();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            $('#searchResults').html(`<p>Error processing your request: ${error}</p>`);
            inputElement.setCustomValidity('An error occurred. Please try again.');
            inputElement.reportValidity();
        }
    }).fail(function() {
        inputElement.setCustomValidity('An error occurred. Please try again.');
        inputElement.reportValidity();
    });
}

// Ingredients tab
function searchIngredients(query) {
    $.ajax({
        url: 'vendors/php/searchIngredient.php', // Ensure this is the correct path
        type: 'GET',
        data: { searchIngredient: query },
        dataType: 'json',
        success: function(response) {
            var inputElement = $('#searchInp')[0]; // Reference to input element
            $('#ingredientsResults').empty(); // Clear previous results

            if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                var tableHtml = `<table class="table"><thead><tr><th>No.</th><th>Ingredient Name</th></tr></thead><tbody>`;
                $('#ingredientsResults').html(tableHtml);

                response.data.forEach(function(ingredient, index) {
                    var rowNumber = index + 1;
                    var capitalisedIngredientName = ingredient.name.charAt(0).toUpperCase() + ingredient.name.slice(1).toLowerCase(); // Capitalize only the first letter
                    var rowHtml = $(`<tr style="opacity: 0;" class="clickable-row" data-id="${ingredient.id}" data-title="${ingredient.name}">
                                      <td><strong>${rowNumber}</strong></td><td>${capitalisedIngredientName}</td></tr>`);

                    // Append the row to the table and animate opacity with a shorter delay
                    rowHtml.appendTo('#ingredientsResults tbody')
                           .delay(index * 10)
                           .animate({ opacity: 1 }, 250); // Smooth transition to full opacity over 250ms
                });

                $('#ingredientsResults').append('</tbody></table>');
                inputElement.setCustomValidity(''); // Clear any custom validation messages
            } else {
                $('#ingredientsResults').html('');
                inputElement.setCustomValidity(query + ' does not match any ingredients. Please enter a valid ingredient.');
                inputElement.reportValidity();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
            $('#ingredientsResults').html(`<p>Error processing your request: ${error}</p>`);
            inputElement.setCustomValidity('An error occurred. Please try again.');
            inputElement.reportValidity();
        }
    }).fail(function() {
        inputElement.setCustomValidity('An error occurred. Please try again.');
        inputElement.reportValidity();
    });
}

//---------------------------------------------------- Modal functionalities ----------------------------------------------------//

$(document).on('click', '.clickable-row', function() {
    var recipeId = $(this).data('id');
    var recipeTitle = $(this).data('title');
    var recipeImage = $(this).data('image'); // Assuming image URL is stored in data-image attribute
    
    $('#recipeModalLabel').text(recipeTitle);
    $('#recipeImage').attr('src', recipeImage); // Set the image src attribute
    
    $('#recipeModal').modal('show');
});