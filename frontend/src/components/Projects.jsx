import React from 'react';

const Projects = () => {
  const projects = [
    {
      id: 1,
      title: "Bravelender",
      description: "A comprehensive lending platform with advanced risk assessment and automated loan processing.",
      technologies: ["React", "Node.js", "MongoDB", "AWS"],
      github: "https://github.com/example/bravelender",
      demo: "https://bravelender-demo.com"
    },
    {
      id: 2,
      title: "E-Commerce Platform",
      description: "Full-featured online shopping platform with payment integration and inventory management.",
      technologies: ["Vue.js", "Express", "PostgreSQL", "Stripe"],
      github: "https://github.com/example/ecommerce",
      demo: "https://ecommerce-demo.com"
    },
    {
      id: 3,
      title: "Task Management App",
      description: "Collaborative task management tool with real-time updates and team features.",
      technologies: ["React", "Firebase", "Material UI"],
      github: "https://github.com/example/taskapp",
      demo: "https://taskapp-demo.com"
    }
  ];

  return (
    <section id="projects" className="projects section">
      <div className="container">
        <h2 className="section-title">My Projects</h2>
        <div className="projects-grid">
          {projects.map((project) => (
            <div key={project.id} className="project-card">
              <div className="project-header">
                <h3>{project.title}</h3>
                <div className="project-links">
                  <a href={project.github} target="_blank" rel="noopener noreferrer">GitHub</a>
                  <a href={project.demo} target="_blank" rel="noopener noreferrer">Live Demo</a>
                </div>
              </div>
              <p className="project-description">{project.description}</p>
              <div className="project-technologies">
                {project.technologies.map((tech, index) => (
                  <span key={index} className="tech-tag">{tech}</span>
                ))}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Projects;