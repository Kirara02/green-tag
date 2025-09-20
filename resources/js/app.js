import './bootstrap'
import Trix from 'trix'

document.addEventListener('DOMContentLoaded', () => {
    // Optimasi untuk mencegah sidebar reload saat navigasi
    // Simpan state sidebar sebelum navigasi
    document.addEventListener('click', function (e) {
        const link = e.target.closest('a[href]')
        if (link && !link.target && !link.href.includes('#')) {
            // Simpan state sidebar ke sessionStorage sebagai backup
            const sidebarState = document.querySelector('[x-data]')?.__x?.$data?.sidebarExpanded
            if (sidebarState !== undefined) {
                sessionStorage.setItem('sidebar_expanded_backup', sidebarState)
            }
        }
    })

    // Restore state sidebar dari sessionStorage jika ada
    window.addEventListener('pageshow', function () {
        const backupState = sessionStorage.getItem('sidebar_expanded_backup')
        if (backupState !== null) {
            const sidebarData = document.querySelector('[x-data]')?.__x?.$data
            if (sidebarData && sidebarData.sidebarExpanded !== JSON.parse(backupState)) {
                sidebarData.sidebarExpanded = JSON.parse(backupState)
            }
        }
    })
})
