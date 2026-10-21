/**
 * ============================================================
 * LEGAiSEE CAREER PAGE - PORTFOLIO CONFIGURATION (FOLDER TREE)
 * ============================================================
 * This is the ONLY file you need to edit to update the page.
 *
 * STRUCTURE: This is a folder tree, like folders on a computer.
 * Each entry below is either a FOLDER or an ITEM.
 *
 * A FOLDER has an id, a label, and a list of children.
 * The label is the text that shows on the card.
 * The children list holds more folders or items inside it.
 *
 * A VIDEO ITEM has an id, the word video, an enabled setting,
 * a url pointing to a YouTube link, a title, and a description.
 *
 * A PHOTO ITEM has an id, the word photo, an enabled setting,
 * a url pointing to a direct image link, a title, and a
 * description.
 *
 * Look at the real folders and items further down this file
 * to see the exact formatting - copy an existing block rather
 * than typing one from scratch.
 *
 * RULES:
 * - Every id must be unique across the whole file.
 * - A folder holds other folders or items - it has no url,
 *   type, or enabled setting of its own.
 * - An item that is disabled or has an empty url will not show.
 * - You can nest folders as many levels deep as you want.
 * - You can add or delete folders and items freely - just keep
 *   every opening bracket matched with a closing bracket.
 *
 * IMPORTANT: Edit this file ONLY in a plain text editor or in
 * cPanel's Code Editor (the "No editor" option you already
 * used successfully). NEVER open or edit it in Google Docs,
 * Word, or Pages - those corrupt the quote marks and break
 * the whole file.
 *
 * ALSO IMPORTANT: When getting this file from Claude, always
 * use the Download button, never the Copy button. Copy pulls
 * from a formatted preview and can introduce corrupted quote
 * marks and stray characters. Download gives you the exact
 * raw file with nothing altered.
 * ============================================================
 */

const CAREER_CONFIG = {

  /* -- PAGE META -------------------------------------------- */
  meta: {
    name:       'John Carr',
    title:      'Broadcast Director / Multimedia Producer / Aerial Cinematographer',
    tagline:    'Thirty years of broadcast-grade production. One standard of excellence.',
    email:      'john@legaisee.com',
    phone:      '',
    location:   'New Braunfels, TX',
    linkedin:   '',
    resume_url: '',
  },

  /* -- CREDENTIALS (pills shown in hero) --------------------- */
  credentials: [
    'KPLC NBC - Broadcast/Technical Director',
    'KVHP FOX 29 - Head Broadcast/Technical Director',
    'Addy Award Recipient',
    'FAA Part 107 Certified',
    'Houston Methodist Hospital',
    '33-Year Production Career',
  ],

  /* -- CAREER STATS ------------------------------------------ */
  stats: [
    { value: '33+', label: 'Years in Production' },
    { value: '14',  label: 'Years Broadcast Television' },
    { value: '10+', label: 'Years Drone / Aerial' },
    { value: '1000s', label: 'Hours of Live Direction' },
  ],

  /* ============================================================
   * PORTFOLIO FOLDER TREE
   * ============================================================ */
  portfolio: [

    /* ---------------------------------------------------------
       FEATURED - things you want easy to find, not tied to
       a specific era or station (reels, business cards, etc.)
    --------------------------------------------------------- */
    {
      id: 'featured',
      label: 'Featured / Demo Reel',
      children: [
        {
          id: 'featured-1',
          type: 'video',
          enabled: true,
          url: 'https://youtu.be/qcjBBnZu3ho',
          title: 'Carr Multimedia - Video Business Card',
          description: '',
        },
        {
          id: 'featured-2',
          type: 'video',
          enabled: true,
          url: 'https://youtu.be/5S8pyOth_sc',
          title: 'Texas Flying Legends Museum | P51 Mustang',
          description: '',
        },
      ],
    },

    /* ---------------------------------------------------------
       ERA ONE - BROADCAST YEARS (1992-2006)
    --------------------------------------------------------- */
    {
      id: 'era-one',
      label: 'Era One - Broadcast Years',
      children: [

   {
  id: 'kplc',
  label: 'KPLC NBC',
  children: [

    {
      id: 'kplc-show-1',
      type: 'video',
      enabled: true,
      url: 'https://youtu.be/qhjh1pmryGE?si=-tL4PeSh0u8h0GsS',
      title: 'KPLC-TV-7 News Nightcast',
      description: '10pm News - November 29, 2001'
    },

    {
      id: 'kplc-show-2',
      type: 'video',
      enabled: true,
      url: 'https://youtu.be/cKUqNY1RETQ?si=XqdMQooSADMFyHL8',
      title: 'KPLC TV 2000',
      description: '7 News Nightcast Open 2000'
    },

    {
      id: 'kplc-show-3',
      type: 'video',
      enabled: true,
      url: 'https://youtu.be/pqujsuNJa7Q?si=NbY7WKzzqVoftowY',
      title: 'KPLC TV Station IDs 1999',
      description: 'Various Station IDs from 1999'
    },

    {
      id: 'kplc-show-4',
      type: 'video',
      enabled: true,
      url: 'https://youtu.be/vf6LFsYJWTw?si=bkJWUGB2xExPytq8',
      title: 'KPLC 7 News Open 1997 Everyday Music Package',
      description: '10pm News - November 29, 2001'
    },

    {
      id: 'kplc-show-5',
      type: 'video',
      enabled: true,
      url: 'https://youtu.be/QIiLGcVJ6iM?si=lxPpIJSgYR1iV4R0',
      title: 'KPLC-TV-7 News at 6',
      description: 'Vincent Settlement Memorial Day Block Party'
    },

    {
      id: 'kplc-show-6',
      type: 'video',
      enabled: false,
      url: '',
      title: '',
      description: ''
    }

  ]
},

        {
          id: 'kvhp',
          label: 'KVHP FOX 29',
          children: [
            {
              id: 'kvhp-commercials',
              label: 'Commercials',
              children: [
                { id: 'kvhp-comm-1', type: 'video', enabled: false, url: '', title: '', description: '' },
                { id: 'kvhp-comm-2', type: 'video', enabled: false, url: '', title: '', description: '' },
              ],
            },
            {
              id: 'kvhp-promos',
              label: 'Station Promos',
              children: [
                { id: 'kvhp-promo-1', type: 'video', enabled: true, url: 'https://youtu.be/jqMqqvwQRk8?si=EIjo5dXi2XFqr23T', title: 'KVHP-TV FOX29 Sunny News Promo', description: 'Addy Award Winning Morning Show Promo' },

                { id: 'kvhp-promo-2', type: 'video', enabled: true, url: 'https://youtu.be/0_w5jb7peiA?si=HyzKYPyCUWWENCuK', title: 'KVHP-TV FOX29 5:00 News Launch Promo', description: 'Promo for the first airing of the new 5pm newscast. 9/11 happened the next day!' },

                { id: 'kvhp-promo-3', type: 'video', enabled: true, url: 'https://youtu.be/RDx64LgHXZs?si=omel-g8yqdIzw7e9', title: 'KVHP-TV FOX29 News Wire Promo', description: 'News Promo that fillows the signal path of a story from start to finish' },

                { id: 'kvhp-promo-4', type: 'video', enabled: true, url: 'https://youtu.be/V2Y-J1QbnMA?si=iMlZs20NmxUCCjxx', title: 'KVHP-FOX29 Sci-Fi Promo', description: 'Promotion for all the Sci-Fi Shows Fox29 was airing at the time' },

                { id: 'kvhp-promo-5', type: 'video', enabled: true, url: 'https://youtu.be/AqFuUF4y-xM?si=2Yb4_1mkUkfj-sK3', title: 'Star Wars-Episode 1 Promo', description: 'Promotion for the Fox airing of Episode 1' },

                { id: 'kvhp-promo-6', type: 'video', enabled: true, url: 'https://youtu.be/aYLgvAwA5bE?si=5fjuABypCAS0kVuh', title: 'Fox29 Jedi', description: 'While rehearsing for the Episode 1 Promo a Saber Stick broke. So we animated it and threw it on the air for fun' },

                { id: 'kvhp-promo-7', type: 'video', enabled: true, url: 'https://youtu.be/9MdRILcY75Q?si=RVuFAmxmYu8Lokn-', title: 'Trekies', description: 'Promotion for the airing of syndication of Star Trek Voyager' },

                { id: 'kvhp-promo-8', type: 'video', enabled: true, url: 'https://youtu.be/HaujgmmwNhQ?si=HSC6XPJ4iggntWn8', title: 'KVHP-TV FOX29 Its About Time', description: 'Promotion for Fox29 9pm Newscast is better than competitors 10pm' },

                { id: 'kvhp-promo-9', type: 'video', enabled: true, url: 'https://youtu.be/cqacMus9nEs?si=h2Wje9DzS102zLB4', title: 'FOX29 Its About TIME 2', description: '2nd followup promo for 9pm newscast' },

                { id: 'kvhp-promo-10', type: 'video', enabled: true, url: 'https://youtu.be/SNfH0oBv66E?si=GSInUSrlBVP4z9xX', title: 'KVHP-TV FOX29 Testimonial News Promo', description: 'Man On The Street Testimonials for FOX29 News At Nine' },

                { id: 'kvhp-promo-11', type: 'video', enabled: true, url: 'https://youtu.be/CXQHR1NWAMo?si=i33Kdja68ydZvIg2', title: 'KVHP-TV FOX29 Salute The Troops', description: 'Saluting the Military men and women fighting over seas' },

                { id: 'kvhp-promo-12', type: 'video', enabled: true, url: 'https://youtu.be/WNjHLNtEsDc?si=mwhUzDZnqhfToW4c', title: 'One Flag', description: '4th of July community promo' },

                { id: 'kvhp-promo-13', type: 'video', enabled: true, url: 'https://youtu.be/mSGkCuZaBkA?si=DEk2olIt8xZuLE4z', title: 'KVHP-TV FOX29 Heartbeat', description: 'The heartbeat of the news promo' },

                { id: 'kvhp-promo-14', type: 'video', enabled: true, url: 'https://youtu.be/vRKCEB055HE?si=jG-_48f_s9nikLRT', title: 'KVHP-TV FOX29 Contraband Cannon', description: 'Promo fir the Contraband Days Festifal tennis tournament' },

                { id: 'kvhp-promo-15', type: 'video', enabled: true, url: 'https://youtu.be/Q1vBfBKUG6w?si=HdRx5yFRYDJ1mKHY', title: 'Judge TV', description: 'Promo for all the syndicated courtroom drama shows' },
              ],
            },
            {
              id: 'kvhp-shows',
              label: 'In-House Produced Shows',
              children: [
                { id: 'kvhp-show-1', type: 'video', enabled: false, url: '', title: '', description: '' },
                { id: 'kvhp-show-2', type: 'video', enabled: false, url: '', title: '', description: '' },
              ],
            },
          ],
        },

        {
          id: 'wlft',
          label: 'WLFT',
          children: [
            {
              id: 'wlft-commercials',
              label: 'Commercials',
              children: [
                { id: 'wlft-comm-1', type: 'video', enabled: false, url: '', title: '', description: '' },
                { id: 'wlft-comm-2', type: 'video', enabled: false, url: '', title: '', description: '' },
              ],
            },
            {
              id: 'wlft-promos',
              label: 'Station Promos',
              children: [
                { id: 'wlft-promo-1', type: 'video', enabled: false, url: '', title: '', description: '' },
                { id: 'wlft-promo-2', type: 'video', enabled: false, url: '', title: '', description: '' },
              ],
            },
            {
              id: 'wlft-shows',
              label: 'In-House Produced Shows',
              children: [
                { id: 'wlft-show-1', type: 'video', enabled: false, url: '', title: '', description: '' },
                { id: 'wlft-show-2', type: 'video', enabled: false, url: '', title: '', description: '' },
              ],
            },
          ],
        },

      ],
    },

    /* ---------------------------------------------------------
       ERA TWO - PRODUCTION BUILD (2006-2020)
    --------------------------------------------------------- */
    {
      id: 'era-two',
      label: 'Era Two - Production Build',
      children: [

        {
          id: 'institutional',
          label: 'Institutional (Houston Methodist, etc.)',
          children: [
            { id: 'inst-1', type: 'video', enabled: false, url: '', title: '', description: '' },
            { id: 'inst-2', type: 'video', enabled: false, url: '', title: '', description: '' },
          ],
        },

        {
          id: 'corporate',
          label: 'Corporate Production',
          children: [
            { id: 'corp-1', type: 'video', enabled: false, url: '', title: '', description: '' },
            { id: 'corp-2', type: 'video', enabled: false, url: '', title: '', description: '' },
          ],
        },

        {
          id: 'aerial',
          label: 'Aerial / Drone',
          children: [
            { id: 'aerial-1', type: 'video', enabled: false, url: '', title: '', description: '' },
            { id: 'aerial-2', type: 'photo', enabled: false, url: '', title: '', description: '' },
          ],
        },

      ],
    },

    /* ---------------------------------------------------------
       ERA THREE - METHODOLOGY ERA (2020-Present)
    --------------------------------------------------------- */
    {
      id: 'era-three',
      label: 'Era Three - Methodology Era',
      children: [

        {
          id: 'legaisee-work',
          label: 'LEGAiSEE / Carr Multimedia',
          children: [
            { id: 'leg-1', type: 'video', enabled: false, url: '', title: '', description: '' },
            { id: 'leg-2', type: 'video', enabled: false, url: '', title: '', description: '' },
          ],
        },

        {
          id: 'other-recent',
          label: 'Other Recent Work',
          children: [
            { id: 'other-1', type: 'video', enabled: false, url: '', title: '', description: '' },
            { id: 'other-2', type: 'photo', enabled: false, url: '', title: '', description: '' },
          ],
        },

      ],
    },

    /* -- ADD MORE TOP-LEVEL FOLDERS OR ITEMS BY COPYING A BLOCK ABOVE -- */

  ],

};