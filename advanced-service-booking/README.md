# Advanced Service Booking & Quotation Builder

A premium SaaS-style service quotation and booking builder for WordPress.

## How It Works

### 1. Setup
- Install and activate the plugin.
- Custom database tables are created automatically upon activation.
- Go to the **Service Booking** menu in the WordPress admin to create **Service Tabs**.
- Add **Packages** to your service tabs.

### 2. Frontend Integration
- Use the shortcode `[advanced_service_booking]` on any page or post.
- Alternatively, use the **ASB Booking Builder** widget in Elementor.

### 3. User Workflow
1. **Selection**: Users browse through service tabs. Clicking a tab loads services via AJAX.
2. **Persistence**: Users can select packages and services across multiple tabs. Selections are saved in the browser session/JS state.
3. **Summary**: A sticky sidebar shows the real-time order breakdown and total price.
4. **Discounts**: Automatic discounts are applied if extra services are selected (configurable in settings).
5. **Submission**: Users fill out the request form and submit.

### 4. Fulfillment
- The submission is saved to the database.
- A PDF quotation is generated using Dompdf.
- An email with the PDF attachment is sent to both the customer and the admin.

## Features
- PHP OOP Architecture
- AJAX-powered dynamic UI
- Custom MySQL tables for performance
- Elementor Widget support
- RTL & Arabic support
- Responsive Mobile-first design
- PDF Quotation generation
- Automated Email system
