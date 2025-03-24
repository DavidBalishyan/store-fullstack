const API_BASE = "http://st.local/src/routes";  // Change to your actual backend URL


// Register User
document.getElementById("registerForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();
    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const response = await fetch(`${API_BASE}/users.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, email, password })
    });

    const data = await response.json();
    console.log(data.message || data.error);
    if (response.ok) window.location.href = "login.html";
});

// Login User
document.getElementById("loginForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const response = await fetch(`${API_BASE}/users.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password })
    });

    const data = await response.json();
    if (response.ok) {
        localStorage.setItem("user", JSON.stringify(data));
        window.location.href = "dashboard.html";
    } else {
        alert(data.error);
    }
});

// Logout User
document.getElementById("logoutBtn")?.addEventListener("click", async () => {
    await fetch(`${API_BASE}?logout=true`);
    localStorage.removeItem("user");
    window.location.href = "login.html";
});
