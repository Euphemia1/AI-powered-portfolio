import React from 'react';

const Hero = () => {
  return (
    <section id="hero" className="hero section">
      <div className="container">
        <div className="hero-content">
          <div className="hero-text">
            <h1>Hello, I'm a Full Stack Developer</h1>
            <p>
              I build exceptional digital experiences that are fast, accessible, visually appealing, and responsive.
              Even if you don't know what those words mean, I can help you achieve your online goals.
            </p>
            <div className="hero-buttons">
              <a href="#projects" className="btn">View My Work</a>
              <a href="#contact" className="btn btn-outline">Contact Me</a>
            </div>
          </div>
          <div className="hero-image">
            <div className="avatar-placeholder">
              <span>👨‍💻</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;