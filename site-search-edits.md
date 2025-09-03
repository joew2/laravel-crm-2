# Laravel Header & Search Modification Plan

## Objective

Modify the existing Laravel project layout to improve search placement, header structure, and advanced search access while keeping existing functionality intact.

---

## 1. Move General Search to Header

-   **Current Location**: Navigation menu
-   **New Location**: Inside the `<header>` tag, below the navigation
-   **Positioning**:
    -   Right-aligned within the header section
    -   Maintain responsive behavior for mobile and desktop
-   **Existing Header Content**:
    -   Keep the existing `<h2>` in the header (displayed to the left)
-   **Implementation Notes**:
    -   Ensure form submission and search functionality remain unchanged
    -   Reuse existing search methods in the controller

---

## 2. Relocate Existing Right-Side Buttons

-   **Current Location**: Right side of the header
-   **New Location**: Below the header, within the main body/content area
-   **Implementation Notes**:
    -   Preserve all button functionality
    -   Maintain visual consistency and spacing
    -   Consider responsive behavior on smaller screens

---

## 3. Modify Advanced Search Access

-   **Current Implementation**: Dropdown jump menu attached to the general search input
-   **Changes**:
    -   Remove the existing dropdown menu entirely
    -   Replace with a filter icon (e.g., a funnel icon)
    -   Clicking the filter icon should navigate to the advanced search page
-   **Positioning**:
    -   Place the filter icon next to the general search input, maintaining alignment with right side of the header
    -   Ensure icon is clearly visible and intuitive for users

---

## 4. Frontend Considerations

-   **Search Input & Filter Icon**:
    -   Maintain current styling as much as possible
    -   Ensure alignment with header elements
-   **Buttons Relocated to Body**:
    -   Place in a container with proper padding/margins to maintain visual hierarchy
-   **Responsive Design**:
    -   Ensure search input, filter icon, and buttons display correctly on mobile and desktop
-   **Accessibility**:
    -   Add `aria-label` to the search input and filter icon for screen readers

---

## 5. Backend Considerations

-   **No backend changes** are required if only moving elements and updating links
-   **Existing Search Methods**:
    -   General search methods remain unchanged
    -   Advanced search page link should point to the current advanced search route

---

## 6. Testing

-   Verify general search works correctly from new location
-   Confirm filter icon navigates to advanced search page
-   Ensure all buttons moved to body retain their functionality
-   Check responsive layout for mobile and desktop
-   Confirm visual alignment of header `<h2>` and search input on different screen sizes

---

## Deliverables

-   General search moved to header (right-aligned)
-   Header `<h2>` remains on the left
-   Existing right-side buttons moved below header into body
-   Advanced search dropdown replaced by filter icon linking to advanced search page
-   Responsive and visually consistent layout maintained
