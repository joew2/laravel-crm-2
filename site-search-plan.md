# Laravel Search Feature Implementation Plan

## Objective

Add a general and advanced search functionality to the existing Laravel application to allow users to search contacts and companies. The implementation should integrate seamlessly with the current codebase, reusing existing actions and UI patterns wherever possible.

---

## Features Overview

### 1. General Search

-   **Input**: A single search box in the header for users to enter keywords.
-   **Search Scope**:
    -   Contacts: first name, last name, email, phone number
    -   Companies: company name
-   **Results Display**:
    -   List view showing:
        -   Company name (left-aligned)
        -   Contact first name, last name, and company title
        -   Current action links (reuse existing actions)
-   **Result Detail**:
    -   Each row corresponds to a single contact with the associated company displayed

---

### 2. Advanced Search

-   **Access**:
    -   A dropdown or button next to the general search box
    -   Clicking opens a dedicated page for advanced search
-   **Filter Options**:
    -   All available fields from `contacts` and `companies` tables
    -   Examples: city, state, industry, job title, email, phone
-   **Results Display**:
    -   Same as general search (list view with company name, contact info, and action links)
-   **Sorting & Pagination**:
    -   Optional: allow sorting by company name, contact last name, etc.
    -   Use pagination for large result sets to maintain performance

---

## Database Considerations

-   **Sample Data**:
    -   Add additional demo contacts and companies to ensure the search functionality works effectively
    -   Include variations in names, emails, phone formats, and company titles for testing

---

## Implementation Approach

1. **Backend**

    - Create a `SearchController` (or extend an existing controller)
    - Add a `generalSearch` method to handle keyword queries
        - Use Eloquent `where` or `whereLike` queries to filter across multiple fields
        - Join `contacts` and `companies` as necessary
    - Add an `advancedSearch` method for complex filters
        - Accept multiple query parameters
        - Use conditional queries to filter by any field provided
    - Return results as JSON or pass to a view for rendering

2. **Frontend**

    - **General Search**:
        - Input box in the existing layout
        - Submit form via GET request to `SearchController@generalSearch`
        - Display results in a list view using the same template as other list displays
    - **Advanced Search**:
        - Dropdown/button next to search input
        - Redirect to `search/advanced` page with filter form
        - Display results similarly to general search
    - Maintain current styling and action link functionality

3. **Testing**
    - Populate sample data
    - Test searches for:
        - Partial matches (e.g., "Jo" matches "John")
        - Case-insensitive searches
        - Searches with multiple filters in advanced mode
    - Ensure pagination works with large data sets
    - Confirm actions links function for each result

---

## Future Considerations

-   Optionally, implement AJAX-based search for faster results
-   Highlight matched keywords in results
-   Add export functionality for search results (CSV/PDF)

---

## Deliverables

-   General search input with working results list
-   Advanced search page with detailed filters
-   Seeded sample data for testing
-   Reuse of current action links and UI elements
