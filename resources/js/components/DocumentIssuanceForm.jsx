import { useMemo, useState } from 'react';
import { Bell, FileText, PhilippinePeso, Printer, Search } from 'lucide-react';

const DOC_TYPES = ['Barangay Clearance', 'Indigency', 'Residency', 'Business Permit'];

export default function DocumentIssuanceForm({ residents = [], onSubmit }) {
    const [query, setQuery] = useState('');
    const [residentId, setResidentId] = useState('');
    const [documentType, setDocumentType] = useState(DOC_TYPES[0]);
    const [purpose, setPurpose] = useState('');
    const [orNumber, setOrNumber] = useState('');
    const [amountPaid, setAmountPaid] = useState('');
    const [paymentDate, setPaymentDate] = useState('');

    const filteredResidents = useMemo(() => {
        const q = query.trim().toLowerCase();
        if (!q) return residents;
        return residents.filter((r) => `${r.last_name}, ${r.first_name}`.toLowerCase().includes(q));
    }, [query, residents]);

    const selectedResident = residents.find((r) => String(r.id) === String(residentId));

    const handleSubmit = (e) => {
        e.preventDefault();
        onSubmit?.({
            resident_id: residentId,
            document_type: documentType,
            purpose,
            or_number: orNumber,
            amount_paid: amountPaid,
            payment_date: paymentDate || null,
        });
    };

    return (
        <div className="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div className="flex items-center justify-between">
                <div>
                    <p className="text-xs font-extrabold uppercase tracking-[0.2em] text-teal-600">Transactions</p>
                    <h2 className="mt-2 text-2xl font-black text-slate-900">Document Issuance</h2>
                </div>
                <Bell className="h-5 w-5 text-slate-400" />
            </div>

            <form className="grid grid-cols-1 gap-4 md:grid-cols-2" onSubmit={handleSubmit}>
                <label className="relative md:col-span-2">
                    <Search className="absolute left-3 top-3.5 h-4 w-4 text-slate-400" />
                    <input
                        value={query}
                        onChange={(e) => setQuery(e.target.value)}
                        placeholder="Search resident"
                        className="w-full rounded-xl border border-slate-200 py-3 pl-9 pr-3 text-sm outline-none focus:border-teal-400"
                    />
                </label>

                <select value={residentId} onChange={(e) => setResidentId(e.target.value)} className="rounded-xl border border-slate-200 px-3 py-3 text-sm">
                    <option value="">Select Resident</option>
                    {filteredResidents.map((r) => (
                        <option key={r.id} value={r.id}>
                            {r.last_name}, {r.first_name}
                        </option>
                    ))}
                </select>

                <select value={documentType} onChange={(e) => setDocumentType(e.target.value)} className="rounded-xl border border-slate-200 px-3 py-3 text-sm">
                    {DOC_TYPES.map((type) => (
                        <option key={type} value={type}>
                            {type}
                        </option>
                    ))}
                </select>

                <input value={purpose} onChange={(e) => setPurpose(e.target.value)} className="rounded-xl border border-slate-200 px-3 py-3 text-sm md:col-span-2" placeholder="Purpose" />
                <input value={orNumber} onChange={(e) => setOrNumber(e.target.value)} className="rounded-xl border border-slate-200 px-3 py-3 text-sm" placeholder="OR Number" />
                <label className="relative">
                    <PhilippinePeso className="absolute left-3 top-3.5 h-4 w-4 text-slate-400" />
                    <input value={amountPaid} onChange={(e) => setAmountPaid(e.target.value)} className="w-full rounded-xl border border-slate-200 py-3 pl-8 pr-3 text-sm" placeholder="Amount Paid" />
                </label>
                <input type="date" value={paymentDate} onChange={(e) => setPaymentDate(e.target.value)} className="rounded-xl border border-slate-200 px-3 py-3 text-sm" />

                <div className="md:col-span-2 flex items-center justify-between rounded-xl bg-slate-50 p-4">
                    <div className="text-sm text-slate-700">
                        <FileText className="mr-2 inline h-4 w-4 text-teal-600" />
                        {selectedResident ? `Preview ready for ${selectedResident.first_name}` : 'Select resident to generate certificate preview'}
                    </div>
                    <button type="submit" className="inline-flex items-center gap-2 rounded-xl bg-teal-600 px-4 py-2 text-sm font-bold text-white">
                        <Printer className="h-4 w-4" />
                        Save Request
                    </button>
                </div>
            </form>
        </div>
    );
}
