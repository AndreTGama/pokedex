'use client';

import Image from 'next/image';
import Logo from "@/assets/img/logo.webp";

export function Navbar() {
  return (
    <nav className="bg-white border-gray-200 dark:bg-gray-900">
      <div className="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
        <a href="https://flowbite.com/" className="flex items-center space-x-3 rtl:space-x-reverse">
          <Image src={Logo} alt="Pokemon Logo" height={64}/>
        </a>
      </div>
    </nav>
  );
}